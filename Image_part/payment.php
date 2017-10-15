<?php
session_start();
ob_start();
include('includes/database2.php');
?>

<?php
$_SESSION['temp_district']=$_POST['district'];
$_SESSION['temp_zone']=$_POST['zone'];

$updatePlace="UPDATE person SET zone='".$_SESSION['temp_zone']."', district='".$_SESSION['temp_district']."' WHERE image_name='".$_SESSION['final_name'].".png'";
	 $check4 = $mysqli->query($updatePlace) or die($mysqli->error.__LINE__);


	$_SESSION['path']='templates/'.$_SESSION['final_name'].'.png';//$_SESSION['temp_name']
//$_SESSION['path2']='../test/pictures/election/'.$_SESSION['temp_zone'].'/'.$_SESSION['temp_district'].'/'.$_SESSION['temp_name'].'.png';
$_SESSION['path2']='../test/pictures/election/'.$_SESSION['temp_zone'].'/'.$_SESSION['temp_district'].'/'.$_SESSION['final_name'].'.png';

copy($_SESSION['path'],$_SESSION['path2']);

?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
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

<body>
	<script type="text/javascript">
	var first_name = "<?php echo $_SESSION['id1'] ?>";

		var zone = "<?php echo $_POST['zone'] ?>";
		var district = "<?php echo $_POST['district'] ?>";
		var person = "<?php echo $_SESSION['id1'] ?>";
		var p1 = "Vote For " + "<?php echo $_SESSION['first_name1'] ?>"+ " <?php echo $_SESSION['mid_name2'] ?>" + " <?php echo $_SESSION['last_name3'] ?>";
		var pers="<?php echo $_SESSION['final_name'] ?>"; 
		var p2 = "I support " + "<?php echo $_SESSION['first_name1'] ?>"+ " <?php echo $_SESSION['mid_name2'] ?>" + " <?php echo $_SESSION['last_name3'] ?>" +" What about yuh?";
		var p4 = "http://photooverlay.com/test/first.php?theme=election&zone=" + zone + "&district=" + district + "&person=" + person;
		console.log(zone);

	function shareInFB() {
		var pin = document.getElementById("pin").value;
		console.log(pin);
		if(pin=="1234") {
			document.getElementById("myText").innerHTML = "";
		var p3 = "http://photooverlay.com/test/pictures/share/" +  first_name +pers+ ".png";
			console.log(p3);
		FB.ui({
				method: 'feed',
				link: p4,
				caption: 'An example caption',
				description: p2,
				name: p1,
				picture: p3
			}, function(response){});
		} else {
			document.getElementById("myText").innerHTML = "Pin Number Not Matched";
		}
		}
			function statusChangeCallback(response) {
					console.log('statusChangeCallback');
					console.log(response);
					if (response.status === 'connected') {
							// Logged into your app and Facebook.
							retrieve_profile_pic();
					} else if (response.status === 'not_authorized') {
							// The person is logged into Facebook, but not your app.
							console.log("nonono");
					} else {
							// The person is not logged into Facebook, so we're not sure if
							// they are logged into this app or not.
							console.log("not Logged in");
					}
			}
			function retrieve_profile_pic() {
				FB.api('/me', {
												fields: 'id,link,name,picture,first_name,last_name,gender,email'
										},
										function(response) {
											var im1 = document.getElementById("profileImage").setAttribute("src", "http://graph.facebook.com/" + response.id + "/picture?type=small");
					});
			}

			window.fbAsyncInit = function() {
								FB.init({
										appId: '436422293368977',
										cookie: true, // enable cookies to allow the server to access
										// the session
										xfbml: true, // parse social plugins on this page
										version: 'v2.8' // use graph api version 2.8
								});
								FB.getLoginStatus(function(response) {
									console.log(response);
										statusChangeCallback(response);
								});

						};
						// Load the SDK asynchronously
						(function(d, s, id) {
								var js, fjs = d.getElementsByTagName(s)[0];
								if (d.getElementById(id)) return;
								js = d.createElement(s);
								js.id = id;
								js.src = "//connect.facebook.net/en_US/sdk.js";
								fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));


	</script>

	<!-- Navigation -->
	<nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
			<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header page-scroll">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
									<span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
							</button>
							<a class="navbar-brand" href="../">Photo Overlay</a>
							<img class="image-responsive" id="profileImage" src=""></img>
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
<br>
	<br>
	<br>
        <div class="container">

<h1><center><a href="start.php">
APPLY TEMPLATE
</a>

</center></h1>
<br><br>

Transaction ID:<input id= "pin" type="number"  name="username"  required>
<br>
<p id="myText"></p>
<script>
function validate(evt) {
  var theEvent = evt || window.event;
  var key = theEvent.keyCode || theEvent.which;
  key = String.fromCharCode( key );
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>
<br><br>

    </div>
			<button id="shareImage" type="button" style="background-color:#3b5998" class="btn btn-block btn-primary" onclick="shareInFB()">Share In Facebook</button>
 <hr>
</html>
