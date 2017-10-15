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
            <h1>Templates</h1>
            <p>select your templates here</p>
        </div>
    </div>
<div class="container">

<?php
include('includes/database.php');

    $query = "SELECT * FROM zone";
    $check = $mysqli->query($query) or die($mysqli->error.__LINE__);
?>

        <form role="form" method="post" enctype="multipart/form-data" action="all.php?cache=none">
<div class="col-sm-6 col-md-3">
        <select name="zone" onchange="showUser(this.value)">>
            <option value="" selected="1">Zone</option>



        <?php
        if($check->num_rows >0) {
            while ($row=$check->fetch_assoc()){
                echo '<option value='.$row["Zone_Name"].'>'.$row["Zone_Name"].'</option>';
            }
        }
        ?>

        </select>
</div>
<div class="col-sm-6 col-md-3">
        <select id="txtHint" name="district">
            <option value="">District</option>
        </select>
</div><div class="col-sm-6 col-md-3">
            <input type="submit" value="click me">
</div>
    </form>


    </body>

       <div class="container">
 <hr>

        <footer>
            <p>&copy; 2017 Begari Guyz & Co, Inc.</p>
        </footer>
    </div>
</html>
