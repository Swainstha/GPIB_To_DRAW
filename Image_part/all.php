<?php

 session_start();
ob_start();
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
            <h1>Available Templates</h1>
            <p>Select your templates</p>
        </div>
    </div>
<?php
if(isset($_POST['zone']))
{
$_SESSION['temp_zone3']=$_POST['zone'];
}
if(isset($_POST['district']))
{
$_SESSION['temp_district4']=$_POST['district'];
}
        $dirname = '../test/pictures/election/'.$_SESSION['temp_zone3'].'/'.$_SESSION['temp_district4'].'/';
        $images = scandir($dirname);
        shuffle($images);
        $ignore = Array(".", "..");
        
        ?>
         <div class="container">
		<div class="row">
	
		
	<?php
		foreach($images as $curimg){
            if(!in_array($curimg, $ignore)) {
?>
      <div class="col-sm-6 col-md-3">
                <div class="thumbnail">
  <?php              
       echo  '<a href="http://photooverlay.com/test/first.php?theme=election&zone='.$_SESSION['temp_zone3'].'&district='.$_SESSION['temp_district4'].'&person='.$curimg.'&cache=none">
       <img src="'.$dirname.$curimg.'"&w=300&zc=2 alt="" /></a></li>';
			
	?>		
</a></li>




                  	</a>
                </div>
            </div>
            <?php
           }
        }
        ?>
			
	

        
	</div>
</div>
    

    <!-- /container -->

  <div class="container"><hr>
 <footer>
            <p>&copy; 2017 Begari Guyz & Co, Inc.</p>
        </footer>
</div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>
        window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')
    </script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>

</html>
