<?php
session_start();
ob_start();
include('includes/database2.php');
?>

<!DOCTYPE html>
<html>
<title>Custom Template</title>
<head></head>
<body>
<script>
	log.console('<?php echo $length2 ?>');
	</script>
<?php


use PHPImageWorkshop\ImageWorkshop; // Use the namespace of ImageWorkshop

require_once('PHPImageWorkshop/ImageWorkshop.php'); // Be sure of the path to the class
// $layer = ImageWorkshop::initFromPath('temp.jpg');
if(isset($_POST['id'])) {
  $_SESSION['id1']=$_POST['id'];
}
else {
if(isset($_GET['b']))
{
	$_SESSION['bi']=$_GET['b'];
}
$_SESSION['temp_name']=$_SESSION['id1'];
	$_SESSION['first_name1']=$_POST['name'];
$_SESSION['mid_name2']=$_POST['mid_name'];
$temp_first=$_POST['name'];
$temp_mid=$_POST['mid_name'];
$temp_last=$_POST['last_name'];
$_SESSION['last_name3']=$_POST['last_name'];
$_SESSION['city']=$_POST['place'];
$_SESSION['final_name']=$_SESSION['first_name1'].$_SESSION['mid_name2'].$_SESSION['last_name3'];
$final_n=$temp_first." ".$temp_mid." ".$temp_last;


if($_SESSION['bi']==0)
{
$split=explode(" ",$_POST['username']);
$split2=explode("#",$_POST['font_color']);
$_SESSION['font_col']=$_POST['font_color'];
$_SESSION['text']= $_POST['username'];
}
$target_dir="templates/";
/*specifies the directory where the file is going to be placed*/

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
/*specifies the path of the file to be uploaded*/

$uploadOk= 1;/*error check*/

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
/*holds the file extension of the file*/

if(isset($_POST["submit"])){
	$check=getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	if($check !== true){
		/*echo "File is an image - " . $check["mime"] . ".";*/
		$uploadOk=1;
	}else {
		echo "File is not an image.";
		$uploadOk=0;
	}
}/*check if image file is a actual image or fake image*/
/*
if($_FILES["fileToUpload"]["size"]>500000) {
	echo"Sorry, your file is too large.";
	$uploadOk = 0;
}*/

if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" && $imageFileType != "JPG" && $imageFileType != "PNG" && $imageFileType != "JPEG" && $imageFileType != "GIF") {
	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
}


if($uploadOk==0){
	echo "Sorry, your image cannot be loaded, template was not created.";
	header('Location: test_32.php');
	exit;
} else {
	if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_file)){
	imagejpeg(imagecreatefromstring(file_get_contents($target_file)),$target_file,50);

	} else {
		header('Location: test_32.php');
		exit;
		echo		"Sorry, there was an error creating your template.";

	}

}



$firLayer1 = ImageWorkshop::initFromPath($_SESSION['temp_col']);
$font='kokila.ttf';
$firLayer1->resizeInPixel(655, 655,true);
$length=strlen($_SESSION['text']);
$final_words=$_SESSION['first_name1']." ".$_SESSION['mid_name2']." ".$_SESSION['last_name3'];
//$length2=strlen($_SESSION['first_name1']);

$length_first=strlen($temp_first);
$length_second=strlen($temp_mid);
$length_third=strlen($temp_last);
$firLayer2 = ImageWorkshop::initFromPath($target_file);
$length45=strlen($final_n);


if($_SESSION['bi']==0)
{
 $textLayer = ImageWorkshop::initTextLayer($_SESSION['text'], $font, 40, $split2[1], 0);
$firLayer2->resizeInPixel(110, 110);
 }
 else if($_SESSION['bi']==1)
 {
 $firLayer2->resizeInPixel(174, 181);
 }
  else if($_SESSION['bi']==2)
 {
 $firLayer2->resizeInPixel(258, 269);

 }

 $check=1;

if($check==1)
{
$firGroup1 = ImageWorkshop::initVirginLayer(655, 655,true);



if($_SESSION['bi']==0)
{
$firGroup1->addLayer(1, $firLayer2, 15, 13, 'RB');

 $firGroup1->addLayer(1, $textLayer, 40, 43,'LB');

}
else if($_SESSION['bi']==1)
{


$firGroup1->addLayer(1, $firLayer2, 0, 0, 'RB');
}
else if($_SESSION['bi']==2)
{
$firGroup1->addLayer(1, $firLayer2, 0, 0, 'LT');
}



	if($_SESSION['bi']==1)
	{
	 $textLayer = ImageWorkshop::initTextLayer($temp_first, $font, 40,'ffffff', 0);
	  $textLayer2 = ImageWorkshop::initTextLayer($temp_mid, $font, 40,'ffffff', 0);
	 $textLayer3 = ImageWorkshop::initTextLayer($temp_last, $font, 40,'ffffff', 0);
	if($length_second>1)
	{$firGroup1->addLayer(1, $textLayer, 75, 293,'LT');//133-($length_first*11)
	$firGroup1->addLayer(1, $textLayer2, 75, 293+45,'LT');
	$firGroup1->addLayer(1, $textLayer3, 75, 293+90,'LT');
	}
	else
	{
	$firGroup1->addLayer(1, $textLayer, 133-($length_first*11), 320,'LT');

	$firGroup1->addLayer(1, $textLayer3, 133-($length_third*11), 320+50,'LT');
	}
	
	}
	else if ($_SESSION['bi']==2)
	{
	 $textLayer = ImageWorkshop::initTextLayer($final_n, $font, 38,'ffffff', 0);

	$firGroup1->addLayer(1, $textLayer, 462-($length45*9), 80,'LB');
	
	}
  $picpath = "http://graph.facebook.com/" . $_SESSION['id1'] . "/picture?type=large&height=500&width=500";
	$firLayer3 = ImageWorkshop::initFromPath($picpath);

$firGroup1->addLayer(1, $firLayer1,0,0,'RB');
if($_SESSION['bi']==0)
{
 $firGroup1->resizeInPixel(655, 655);
  $_SESSION['text']= $split[0].$split[1].$split[2].$split[3].$split[4].$split[5];
  $image = $firGroup1->getResult("");
  $firLayer3->resizeInPixel(655, 655,false);
  $firGroup1->addLayer(1, $firLayer3,0,0,'RB');

}
else if($_SESSION['bi']==1 || $_SESSION['bi']==2)
{
$firGroup1->resizeInPixel(650, 650,true);
$image = $firGroup1->getResult("");
$firLayer3->resizeInPixel(425, 473,false);
$firGroup1->addLayer(1, $firLayer3,230,0,'LT');
}





//$dirPath =__DIR__."/../templates/".$_SESSION['zone']."/".$_SESSION['district'];
//$_SESSION['path']='templates/'.$_SESSION['temp_name'].'.png';
$_SESSION['path']='templates/'.$_SESSION['final_name'].'.png';
$filename = "final1.png";
$createFolders = true;
$backgroundColor = null; // transparent, only for PNG (otherwise it will be white if set null)
$imageQuality = 95; // useless for GIF, usefull for PNG and JPEG (0 to 100%)

//$firGroup1->save($dirPath, $filename, $createFolders, $backgroundColor, $imageQuality);

imagepng($image,$_SESSION['path']);


$image2 = $firGroup1->getResult("");
$temp="template.jpg";
imagepng($image2,$temp);
if($_SESSION['bi']==1 || $_SESSION['bi']==2)
{
$query4="INSERT INTO  person(id, first_name, middle_name,last_name,image_name,city,counter) VALUES (NULL, '".$_SESSION['first_name1']."', '".$_SESSION['mid_name2']."','".$_SESSION['last_name3']."','".$_SESSION['final_name'].".png','".$_SESSION['city']."',1)";
	 $check4 = $mysqli->query($query4) or die($mysqli->error.__LINE__);
}
$share = ImageWorkshop::initVirginLayer(526, 277,flse);
		$unmerged = ImageWorkshop::initFromPath($picpath);
		$merged = ImageWorkshop::initFromPath($temp);
		$width1=$share->getWidth();
		$height1=$share->getHeight();
		$merged->resizeInPixel($width1/2-7, $height1,false);
		$unmerged->resizeInPixel($width1/2-7, $height1,false);
		$share->addLayer(1, $unmerged, 0, 0,'LT');
		$share->addLayer(1, $merged, $width1/2+7, 0,'LT');
		$final_image = $share->getResult("000");
		$name3="../test/pictures/share/".$_SESSION['id1'].$_SESSION['final_name'].".png";
    imagepng($final_image,$name3);
}
header('Location: test_32.php?first=1&g='.urlencode($temp).'&f='.$_SESSION['path']);
}

?>
</body>
</html>
