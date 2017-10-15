<?php
session_start();
ob_start();
include('includes/database.php');

    $query = "SELECT * FROM zone";
    $check = $mysqli->query($query) or die($mysqli->error.__LINE__);
	use PHPImageWorkshop\ImageWorkshop; // Use the namespace of ImageWorkshop
 
	require_once('PHPImageWorkshop/ImageWorkshop.php'); // Be sure of the path to the class
	if(isset($_GET['v']))
{
	$_SESSION['vi']=$_GET['v'];
}

if(isset($_GET['image']))
{
  $_SESSION['choose']=$_GET['image'];
  $h= $_SESSION['choose'];
  switch($h)
{
	case 'yellow':
	$_SESSION['temp_col']="color/yellow.png";
	break;
	case 'pink':
	$_SESSION['temp_col']="color/pink.png";
	break;
	case 'green':
	$_SESSION['temp_col']="color/green.png";
	break;
	case 'red':
	$_SESSION['temp_col']="color/red.png";
	break;
	case 'pink':
	$_SESSION['temp_col']="color/pink.png";
	break;
	case 'faded_pink':
	$_SESSION['temp_col']="color/faded_pink.png";
	break;
	case 'bluish_purple':
	$_SESSION['temp_col']="color/bluish_purple.png";
	break;
	case 'temp1_green':
	$_SESSION['temp_col']="color/temp1_green.jpg";
	break;
	case 'oranges':
	$_SESSION['temp_col']="color/oranges.png";
	break;
	case 'orange':
	$_SESSION['temp_col']="color/orange.png";
	break;
	case 'dark_blue':
	$_SESSION['temp_col']="color/dark_blue.png";
	break;
	case 'light_blue':
	$_SESSION['temp_col']="color/light_blue.png";
	break;
	case 'light_green';
	$_SESSION['temp_col']="color/light_green.png";
	break;
	case 'dark_green';
	$_SESSION['temp_col']="color/dark_green.png";
	break;
			case 'uml';
	$_SESSION['temp_col']="color/uml1.png";
	break;
		case 'maoist';
	$_SESSION['temp_col']="color/maoist1.png";
	break;
		case 'congress';
	$_SESSION['temp_col']="color/congress1.png";
	break;
		case 'nayashakti';
	$_SESSION['temp_col']="color/nayashakti1.png";
	break;
}
}
  ?>

<!DOCTYPE html>

<script>

function previewFile() {
    // Where you will display your image
    var preview = document.querySelector('img');
    // The button where the user chooses the local image to display
    var file = document.querySelector('input[type=file]').files[0];
    // FileReader instance
    var reader  = new FileReader();

    // When the image is loaded we will set it as source of
    // our img tag
    reader.onloadend = function () {
      preview.src = reader.result;
    }


    if (file) {
      // Load image as a base64 encoded URI
      reader.readAsDataURL(file);
    } else {
      preview.src = "";
    }
  }
</script>




<?php

if(isset($_SESSION['text']))
{
$text1=$_SESSION['text'] ;
}
else  $text1="VOTE_FOR";

 if(isset($_SESSION['temp_name']))
{
$text2=$_SESSION['temp_name'] ;
}
else  $text2="Name";


 if(isset($_SESSION['font_col']))
{
$fcol1=$_SESSION['font_col'] ;
}
else  $fcol1="#ff0000" ;
 if(isset($_SESSION['temp_zone']))
{
$zone=$_SESSION['temp_zone'] ;
}
else  $zone="zone" ;

 if(isset($_SESSION['temp_district']))
{
$district=$_SESSION['temp_district'] ;
}
else  $district="district" ;

 ?>


<html lang="en">
    <head>  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come test_32 in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Photooverlay - Bring your photos to life</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="../css/freelancer.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>
    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="../js/freelancer.min.js"></script>
</head>

        <script>
            function showUser(str) {
                if (str=="") {
                    document.getElementById("txtHint").innerHTML="";
                    return;
                }
                if (window.XMLHttpRequest) {
                    // code for IE7+, Firefox, Chrome, Opera, Safari
                    xmlhttp=new XMLHttpRequest();
                } else { // code for IE6, IE5
                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                xmlhttp.onreadystatechange=function() {
                    if (this.readyState==4 && this.status==200) {
                        document.getElementById("txtHint").innerHTML=this.responseText;
                    }
                }
                console.log(str);
                xmlhttp.open("GET","getuser.php?q="+str,true);
                xmlhttp.send();
            }
        </script>


<body>
  <!-- Navigation -->
  <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
      <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header page-scroll">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                  <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
              </button>
              <a class="navbar-brand" href="../">Photo Overlay</a>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                  <li class="hidden">
                      <a href="#page-top"></a>
                  </li>
                  <li class="page-scroll">
                      <a href="../#portfolio">Templates</a>
                  </li>
                  <li class="page-scroll">
                      <a href="front.html">Customize</a>
                  </li>
                  <li class="page-scroll">
                      <a href="../#contact">Contact</a>
                  </li>
              </ul>
          </div>
          <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
  </nav>
  <br>
  <br>
  <br>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron">
        <div class="container">
            <h1>Templates</h1>
               <div class="col-sm-6 col-md-9"> <p>CREATE YOUR TEMPLATE</p>
</div>
<div class="col-sm-6 col-md-3"> <a href="start.php"><p> APPLY TEMPLATE</p></a>
</div>
        </div>
    </div>
<div class="container">
	<div class="col-sm-6 col-md-9">
<br>
<form action="test2.php?b=<?php echo $_SESSION['vi']; ?>" method="post" enctype="multipart/form-data" style:"center">

		<?php echo 'Name(नाम):<input type="text" name="name" value='.$text2.' size="30" />';
?>
<br><br>
<?php
if($_SESSION['vi']==0){

echo 'Slogan(सन्देश):<input type="text"  name="username" value='.$text1 .' size="30" />';
?>

<br><br>
Font Color(अक्षरको रंग):
<?php echo
  '<input type="color" name="font_color" value='.$fcol1.'>'; } ?>
  <br>

	<br><br>
Select image to upload:(आफ्नो फोटो रोज्नुहोस)
<?php
echo '<input type = "file" name ="fileToUpload"   id="fileToUpload" onchange="previewFile()" required>' ?>
	<img src =""  width="100" height="100" id="logo"><br><br>
	<input type = "submit" value ="Create Template(टेम्प्लेट हेर्नुहोस)" class="btn btn-primary" name="submit">
<br>
</form>
<br>
<br>
<?php echo '<form action="payment.php?name='.$text2.'" method="post">';
?>
  <select name="zone" onchange="showUser(this.value)" required>>
            <option value="" selected="1">Zone(अंचल)</option>';
   
      <?php
        if($check->num_rows >0) {
            while ($row=$check->fetch_assoc()){
                echo '<option value='.$row["Zone_Name"].'>'.$row["Zone_Name"].'</option>';
            }
        }
    ?>
        </select>  
        <select id="txtHint" name="district" required>
            <option value="">District(जिल्ला)</option>
        </select>
		<br><br>
<input type="submit" value="Save and Share (सेभ र शेर गर्नुहोस)" name="submit2" class="btn btn-primary" onclick=clicked(event)>		
</form>

</div>

 <div class="col-sm-6 col-md-3">

<?php
 if(isset($_GET['image'])) {

$sample = ImageWorkshop::initFromPath("bangkok2.jpg");
$sample2 = ImageWorkshop::initFromPath($_SESSION['temp_col']);
$sample->resizeInPixel(300,300);
$sample2->resizeInPixel(300,300);
$firGrp = ImageWorkshop::initVirginLayer(300, 300,true);
$firGrp->addLayer(1, $sample2,0,0,'RB');
$firGrp->addLayer(1, $sample,0,0,'RB');
$image3 = $firGrp->getResult("");
imagepng($image3,"temp.png");
	
 }
 ?>
 


<?php
 if(isset($_GET['f'])) {

$f=$_GET['f'];
	echo '<img src="'.$f.'?cache="none" width="300" height="300" />';
 }
 else echo'
 <img src="temp.png"?cache="none"width="300" height="300" />';
 ?>
 </div>
</div>


<br>
<br>

        <div class="container"><hr>
 <footer>
            <p>&copy; 2017 Begari Guyz & Co, Inc.</p>
        </footer>
</div>

</body>
</html>
