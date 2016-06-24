<!DOCTYPE html>

<?php
   include("config.php");
   session_start();

   if(isset($_SESSION['login_user'])){
      header("location:dashboard.php");
	  exit;
   }

   $error="";

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
	  if(isset($_POST['username']))
      $username = mysqli_real_escape_string($db,$_POST['username']);
	  if(isset($_POST['password']))
      $password = mysqli_real_escape_string($db,$_POST['password']); 
      
      $sql = "SELECT id FROM users WHERE username = '$username' and password = '$password'";
      $result = mysqli_query($db, $sql);
      $count = mysqli_num_rows($result);
      
      // Correct $username and $password
      if($count == 1) {
         $_SESSION['login_user'] = $username;
         
         header("location: dashboard.php");
      }else {
		 if(mysqli_num_rows(mysqli_query($db,"SELECT admin FROM waiting WHERE username = '$username'"))!=0){
			 $error = " UserName awaiting CONFIRMATION...<br>Please go to the Email you provided and confirm your registration!";
		 } 
		 else
         $error = "UserName or Password is invalid !";
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
    <meta name="description" content="file for login page">
    <meta name="author" content="gaurav">
    
    <title>Log In</title>
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">
	
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/login.css" rel="stylesheet">

  
  </head>

  <body>
    <div class="topright">
      <FORM METHOD="LINK" ACTION="register.php">
        <button type="submit" class="register">Register</button>
      </FORM> 
    </div>

    <div class="container">
      
      <form class="form-signin" action="" method="POST">
        <h2 class="form-signin-heading">Log In</h2>
<?php 
	if($error!="")
	echo '<i class="fa fa-exclamation-triangle" aria-hidden="true"></i><b style="color:darkred;">'.$error.'</b>'; 
?>
        <label for="username" class="sr-only">Username</label>
        <input type="text" name="username" class="form-control" value='<?php if(isset($_POST['username']))echo $_POST['username']?>' placeholder="Username" required autofocus>
        <label for="password" class="sr-only">Password</label>
        <input type="password" name="password" class="form-control" value='<?php if(isset($_POST['password']))echo $_POST['password']?>' placeholder="Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        <button class="log" type="submit">Log in</button>
        <br>
		<br>
        <a href=""><p>Forgot Password?</p></a>
      </form>

    </div> <!-- /container -->
      <br><br><br>
    <div class="back">
      <a href="https://www.google.co.in/"><h3 id="back">
  <!-- NOT linked to home page -->
   Back to HOME</h3></a>
    </div>

  </body>
</html>