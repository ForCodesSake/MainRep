<!DOCTYPE html>
<html lang="en">
	<head>
<?php include 'templates/commonHead.php'; ?>
		<title>F.W.R. | Settings</title>
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
	<link rel="stylesheet" href="css/settings.css">


			</head>	

	<body onload="myFunction()" style="margin:0;">
<?php include 'templates/base1.php'; ?>

  <h1 class="page-header">Settings</h1>
  
  <div id="myDiv" class="animate-bottom">

	 <div class="panel-group" id="accordion">
		<div class="panel panel-primary">
		  <div class="panel-heading">
			<h4 class="panel-title">
			  <a data-toggle="collapse" data-parent="#accordion" href="#collapse1" style=" display:block;">Change Name</a>
			</h4>
		  </div>
		  <div id="collapse1" class="panel-collapse collapse in">
			<div class="panel-body">
			<div class="container">
			  <form id="form1" autocomplete="off">
			  <h4>Hey, who do you wanna be today ? (*cough* James Bond ? *cough*) </h4>
			  <label for="name" class="sr-only">Change Name</label>
			  <input type="text" id="newName" class="form-control" value='<?php echo htmlspecialchars($_SESSION['name']) ?>'  placeholder="Enter your Name" pattern="^[a-zA-Z][a-zA-Z\s]*$" maxlength="36" title="Letters and spaces only" required>
			  <div id="notif1"></div>
			  <br>
			  <button type="submit" class="btn btn-success">Save Changes</button>
			  </form>
			</div>
			</div>
		  </div>
		</div>
		<div class="panel panel-primary">
		  <div class="panel-heading">
			<h4 class="panel-title">
			  <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" style=" display:block;">Change Username</a>
			</h4>
		  </div>
		  <div id="collapse2" class="panel-collapse collapse">
			<div class="panel-body">
			<div class="container">
			  <form id="form2" autocomplete="off">
				  <h4>"Lets see if your desired Username is available...(*fingers crossed*)"</h4>
				  <label for="userName" class="sr-only">UserName</label>
				  <input type="text" id="newUsername" class="form-control" value='<?php echo $_SESSION['login_user'] ?>' 
				  placeholder="Enter your UserName" pattern="^[A-Za-z0-9_]{6,36}$" title="Username must be b/w 6 to 36 characters using Alphanumeric characters and _ only" required>
				  <div id="notif2"></div>
				  <br>
			  <button type="submit" class="btn btn-success">Save Changes</button>
			  </form>			
			</div>
			</div>
		  </div>
		</div>
		<div class="panel panel-primary">
		  <div class="panel-heading">
			<h4 class="panel-title">
			  <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" style=" display:block;">Change Password</a>
			</h4>
		  </div>
		  <div id="collapse3" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="container">
				<form id="form3" autocomplete="off">
				  <h3 style="margin-top:0;">"Feeling insecure,are we ? :("</h3>
				  <label for="password" class="sr-only">Current Password</label>
				  <h4>Current Password</h4>
					  <input type="password" id="currPassword" class="form-control" placeholder="Enter your Current Password" required>

					<label for="password" class="sr-only">New Password</label>
					<h4>New Password</h4>
					  <input type="password" id="password1" class="form-control" placeholder="Enter your New Password" pattern=".{6,36}" title="Password must be between 6 to 36 characters" required>

					  <h4>Confirm New Password</h4>
					  <label for="inputPassword" class="sr-only">Confirm New Password</label>
					  <input type="password" id="password2" class="form-control" placeholder="Confirm your New Password" required>
					  <div id="notif3"></div>
					  <br>
					 <button type="submit" class="btn btn-success">Just Do It !</button> 
				</form>
				</div>
			</div>
		  </div>
		</div>
	  </div> 	
			
	</div>
  		
<?php include 'templates/base2.php';?>

	<script>
		var myVar;

		function myFunction() {
			myVar = setTimeout(showPage, 200);
		}

		function showPage() {
		  document.getElementById("myDiv").style.display = "block";
		}
		
		
	</script>
	
	<script src="js/settings.js"></script>	

</body>
</html>