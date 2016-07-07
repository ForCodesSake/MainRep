<!DOCTYPE html>
<?php
   include("config.php");
   session_start();

   if(isset($_SESSION['login_user'])){
      header("location:dashboard.php");
	  exit;
   }
?>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Friends With Ratings Homepage">
    <meta name="author" content="Vedanshu Dahiya">

    <title>Friends With Ratings</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/homepage.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
		<div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a class="tabs" href="login.php" style="font-family:comic sans ms;font-weight:bold;font-size:24px;">Login !</a>
                    </li>
		  </ul>
          <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="tabs" href="register.php" style="font-family:comic sans ms;font-weight:bold;font-size:24px;">SignUp !</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Image Background Page Header -->
    <header class="homepagePicture">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="tagline" align="center" style="font-size:50px">Friends With Ratings &trade;</h1>
                </div>
            </div>
        </div>
    </header>

    <!-- Page Content -->
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h2>Get Started !</h2>
                <p>Bored and tired of searching for a good movie? See what movies your friends have watched, how they rate it and avoid the boring content !</p>
                <p>Have you watched any good Movie recently ? Share your opinion, rate it and suggest it to your friends !</p>
                <p>
                    <a class="btn btn-default btn-lg" href="login.php">Login / Register »</a>
                </p>
            </div>
            <div class="col-sm-4">
                <h2>Contact Us</h2>
                <address>
                    <strong>Email :</strong>
					<br>
					<a href="mailto:vedanshudahiya@gmail.com">vedanshudahiya@gamil.com</a>
                    <br>
					<a href="mailto:#">Shubham@gamil.com</a>
                    <br>
					<a href="mailto:#">Gaurav@gamil.com</a>
                    <br>
                </address>
                <address>
				<strong>Facebook :</strong>
					<br>
					<a href="https://www.facebook.com/vedanshu.dahiya">Vedanshu Dahiya</a>
                    <br>
					<a href="#">Shubham Verma</a>
                    <br>
					<a href="#">Gaurav Kumar Rawat</a>
                    <br>
                </address>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-sm-4">
                <img class="img-circle img-responsive img-center" src="images/user.png">
                <h2 class="aboutName">Vedanshu Dahiya</h2>
                <p class="aboutName">About Me</p>
            </div>
            <div class="col-sm-4">
                <img class="img-circle img-responsive img-center" src="images/user.png">
                <h2 class="aboutName">Shubham Verma</h2>
                <p class="aboutName">About Me</p>
            </div>
            <div class="col-sm-4">
                <img class="img-circle img-responsive img-center" src="images/user.png">
                <h2 class="aboutName">Gaurav Kumar Rawat</h2>
                <p class="aboutName">About Me</p>
            </div>
        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright © Friends With Ratings 2016</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>
	<script src="js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body></html>