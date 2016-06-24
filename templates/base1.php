<?php 
	$thisPage=basename($_SERVER['PHP_SELF']);
?>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Friends With Ratings&trade;</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
			<li <?php if ($thisPage=="about.php") echo "class=\"active\""; ?> ><a href="about.php" class="tabs">About</a></li>
            <li><a href="#" class="tabs" data-toggle="modal" data-target="#myModal">Feedback</a></li>
            <li class="dropdown"><a href="#" class="dropdown-toggle tabs" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello,<span id="helloName"><?php echo ' '.htmlspecialchars($_SESSION['name']) ?></span> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li <?php if ($thisPage=="accountdetails.php") echo "class=\"active\""; ?> ><a href="accountdetails.php">Account Details</a></li>			  
                <li <?php if ($thisPage=="settings.php") echo "class=\"active\""; ?> ><a href="settings.php">Settings</a></li>
                <li role="separator" class="divider"></li>
                <li class="dropdown-header">Fed Up Already ?</li>
                <li><a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Logout</a></li>
              </ul>
            </li>
          </ul>
		  <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </nav>
	
	
			<!-- Modal -->
			<div class="modal fade" id="myModal" role="dialog">
				<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Feedback</h4>
					</div>
					<div class="modal-body">
					<p>Please suggest us ways we can improve this site or point out any bugs you find. We are always learning and happy to help if you need any :)</p>
					<textarea id="tamsg" rows="4" cols="50" wrap ="soft" maxlength="300" style="width:100%;"placeholder="Enter your message... (max 300 letters)"></textarea>
					</div>
					<div class="modal-footer">
					<form id="fbform">
						<button class="btn btn-success" type="submit">Send</button>
					</form>
					</div>
				</div>
				</div>
			</div>

		<div id="myAlert" class="alert alert-success fade in" style="display:none;">
				<a href="#" class="close" onclick="$('.alert').hide()">&times;</a>
				<form class="feedback" >Feedback Submitted Successfully</form>
		</div>

			
	  
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 navbar navbar-inverse sidebar">
          <ul class="nav nav-sidebar">
            <li <?php if ($thisPage=="dashboard.php") echo "class=\"active\""; ?> ><a href="dashboard.php" style="font-size:16px; font-family:Comic Sans MS;"><i class="fa fa-desktop" aria-hidden="true"></i>&nbsp;Dashboard</a></li>
          </ul>
          <ul class="nav nav-sidebar">
			<li><h4>MOVIES</h4></li>
            <li <?php if ($thisPage=="TopRated.php") echo "class=\"active\""; ?> ><a href="#"><i class="fa fa-star" aria-hidden="true"></i>&nbsp;Top Rated</a></li>
            <li <?php if ($thisPage=="RecentAddition.php") echo "class=\"active\""; ?> ><a href="#"><i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;Recent Additions</a></li>
            <li <?php if ($thisPage=="Favourites.php") echo "class=\"active\""; ?> ><a href="#"><i class="fa fa-heart" aria-hidden="true"></i>&nbsp;My Favourites</a></li>
            <li <?php if ($thisPage=="SubmitMovie.php") echo "class=\"active\""; ?> ><a href="#"><i class="fa fa-share" aria-hidden="true"></i>&nbsp;Submit Movie Requests</a></li>
          </ul>
<?php 
	if($_SESSION['admin']) 
		{
?>
          <ul class="nav nav-sidebar">
			<li><h4>Admin Privileges</h4></li>		  
            <li <?php if ($thisPage=="AddMovies.php") echo "class=\"active\""; ?> ><a href="#"><i class="fa fa-plus-square" aria-hidden="true"></i>&nbsp;Add Movies</a></li>
			<li <?php if ($thisPage=="feedback.php") echo "class=\"active\""; ?> ><a href="feedback.php"><i class="fa fa-envelope" aria-hidden="true"></i>&nbsp;View Feedback(s)</a></li>
            <li <?php if ($thisPage=="manageusers.php") echo "class=\"active\""; ?> ><a href="manageusers.php"><i class="fa fa-user-plus" aria-hidden="true"></i><i class="fa fa-user-times" aria-hidden="true"></i>&nbsp;Manage Users</a></li>
          </ul>
<?php   
		} 
?>		  
        </div>
		
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">