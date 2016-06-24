<!DOCTYPE html>
<html lang="en">
	<head>
<?php include 'templates/commonHead.php'; ?>
		<title>F.W.R. | Account Details</title>
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- Custom styles for this template -->
	<link rel="stylesheet" href="css/account.css">

	<body onload="myFunction()" style="margin:0;">
<?php include 'templates/base1.php'; ?>

  <h1 class="page-header">Account Details</h1>
  
  <div id="myDiv" class="animate-bottom">

	    
<div class="container">
      <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
           <A href="settings.php" >Edit Profile</A>
       <br>
	</div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h2 class="panel-title" style="text-align:center; font-weight:bold;"> Impressive Stuff ! </h2>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="images/user.png" class="img-responsive">
                <!-- <a href="#" >Edit Image</a>  -->
                 </div>
                
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
					
                      <tr>
						<td><b>Name:</b></td>
                        <td><?php echo htmlspecialchars($_SESSION['name']); ?></td>
					  </tr>
                      <tr>
                        <td><b>Username:</b></td>
                        <td><?php echo htmlspecialchars($_SESSION['username']); ?></td>
                      </tr>
                      <tr>
                        <td><b>E-mail:</b></td>
                        <td><?php echo htmlspecialchars($_SESSION['email']); ?></td>
                      </tr>
                     
                    </tbody>
                  </table>
                  
                </div>
              </div>
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
	
</body>
</html>