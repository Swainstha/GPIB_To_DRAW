<?php session_start();
ob_start();
 ?>
<!DOCTYPE html>
<html>
    <head></head>
    <body>
        <?php
		
		
		use PHPImageWorkshop\ImageWorkshop; // Use the namespace of ImageWorkshop
 
require_once('PHPImageWorkshop/ImageWorkshop.php'); // Be sure of the path to the class

			
				if(isset($_GET['image']))
				{
				$gradient1 = $_GET['image'];
				}
				else $gradient1=null;
			
		
		$gradient=ImageWorkshop::initFromPath($gradient1);
	

//$image2 = ImageWorkshop::initFromPath('test.png');
 $image2 = ImageWorkshop::initFromPath('final.png');
$image2->resizeInPixel(655, 655,true);
$gradient->resizeInPixel(655,655,false);
$firGroup1 = ImageWorkshop::initVirginLayer($image2->getWidth(), $image2->getHeight());		
$newOpacity = 40;
 
$gradient->opacity($newOpacity);
$firGroup1->addLayer(1, $gradient, 0, 0, 'RB');
$firGroup1->addLayer(1, $image2,0,0,'RB');
$result = $firGroup1->getResult("");
			$name2='final2.png';
          session_unset();
          session_destroy();
          imagepng($result,$name2);
         ?>
        <img id="blah12" src='<?php echo $name2; ?>' style="width:300px;heigh:300px;">
		
		
		<br><br>
		<a href="front.html">GO TO START PAGE</a href>    
		</body>
</html>