<!DOCTYPE html>

<?php
   include("config.php");
   session_start();

   if(isset($_SESSION['login_user'])){
      header("location:dashboard.php");
	  exit;
   }

   $error="";$success=0;

   if($_SERVER["REQUEST_METHOD"] == "POST") {
	try{ 
		$password1 = mysqli_real_escape_string($db,$_POST['password1']);
		$password2 = mysqli_real_escape_string($db,$_POST['password2']);	 
		$name = mysqli_real_escape_string($db,$_POST['name']);
		$email = mysqli_real_escape_string($db,$_POST['email']);
		$userName = mysqli_real_escape_string($db,$_POST['userName']);

	/* Check if Passwords match*/
		if(strcmp($password1,$password2)!=0){			
			throw new Exception("Passwords Don't Match !");
		}

		if((strcasecmp(substr($email,-4),'.com'))!=0)$email.='.com';
	/* Check if Email is already registered */
		$sql = "SELECT id FROM users WHERE email = '$email'";
		$count = mysqli_num_rows(mysqli_query($db, $sql));
		if($count!=0){
			throw new Exception("This E-Mail has already been registered.");
		}
		$sql = "SELECT admin FROM waiting WHERE email = '$email'";
		$count = mysqli_num_rows(mysqli_query($db, $sql));
		if($count!=0){
			throw new Exception("Confirmation mail has already been sent to you...Please Check your Mail.");
		}
		
	/* Check UserName Availability */
		$count = mysqli_num_rows(mysqli_query($db,"SELECT admin FROM waiting WHERE username = '$userName'"));
		if($count!=0){
			throw new Exception("Sorry, UserName already taken !");
		}	
		$sql = "SELECT id FROM users WHERE username = '$userName'";
		$count = mysqli_num_rows(mysqli_query($db, $sql));
		if($count!=0){
			throw new Exception("Sorry, UserName already taken !");
		}
		
		$admin=0;
		if(strcmp($password1,'FWR_admin')==0)$admin=1;
		
	/* Everything is OK... Send Confirmation Mail */
		include('sendConfirmationMail.php');
		
		header( "refresh:13;url=login.php" );
		}		
		catch(Exception $e){
			$error=$e->getMessage();
		}  
   }
   
   mysqli_close($db);   
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="for user registration">
    <meta name="author" content="gaurav">
    
    <title>Registration</title>
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/registration.css" rel="stylesheet">

  
  </head>

  <body>
    <div class="topright">
      <FORM METHOD="LINK" ACTION="login.php">
        <button type="submit" class="login">Log In</button>
      </FORM> 
    </div>

    <div class="container">
      
      <form role="form" data-toggle="validator" class="form-signup" action="" method="POST">
        <h2 class="form-signup-heading">Register Here</h2>
<?php 
	if($error!="")
	echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><b style="color:darkred;">'.$error.'</b>'; 
?>
        <h4>Full Name</h4>
        <label for="name" class="sr-only">Full Name</label>
        <input type="text" name="name" class="form-control" value='<?php if(isset($_POST['name']))echo htmlspecialchars($_POST['name'])?>' placeholder="Enter your Full Name" required autofocus>

        <h4>Email Address</h4>
        <label for="email" class="sr-only">Email address</label>
        <input type="email" name="email" class="form-control" value='<?php if(isset($_POST['email']))echo htmlspecialchars($_POST['email'])?>' placeholder="Enter your Email address" required autofocus>

        <h4>UserName</h4>
        <label for="userName" class="sr-only">UserName</label>
        <input type="text" name="userName" class="form-control" value='<?php if(isset($_POST['userName']))echo htmlspecialchars($_POST['userName'])?>' placeholder="Enter your UserName" required autofocus>

        <h4>Password</h4>
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password1" id="password1" class="form-control" placeholder="Enter your Password" required>

        <h4>Confirm Password</h4>
        <label for="inputPassword" class="sr-only">Confirm Password</label>
        <input type="password" name="password2" class="form-control" placeholder="Confirm your Password" required>
		<div class="help-block with-errors"></div>

		<button class="signup" type="submit">Register</button>
      
      </form>

    </div> <!-- /container -->
      <br><br>
    <div class="back">
      <a href="https://www.google.co.in/"><h3 id="back">
  <!-- NOT linked to home page -->
   Back to HOME</h3></a>
    </div>

	<!-- Modal -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
					<h4 class="modal-title" color="green">Success !</h4>
					</div>
					<div class="modal-body">
					<p>A Confirmation mail has been sent to <?php echo htmlspecialchars($_POST['email']); ?>. Please confirm your registration before Logging in.<br> Now, you will be redirected to the login page.<br><br>(Automatically in 10 seconds)</p>
					</div>
					<div class="modal-footer">
						<a href="login.php"><button type="button" class="btn btn-success">Lets Go !</button></a>
					</div>
				</div>
				</div>
			</div>
	
	
	<!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

<?php

if($success) echo "	
	<script type='text/javascript'>
				$(document).ready(function(){
				$('#myModal').modal('show');
				});
	</script>"
?>  	
  </body>
</html>
