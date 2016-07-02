<!DOCTYPE html>
<html lang="en">
	<head>
<?php include 'templates/commonHead.php'; ?>
		<title>F.W.R.</title>
		
    <!-- Custom styles for this template -->
	
	
	</head>

	<body>
<?php include 'templates/base1.php'; ?>

		
    <h1 class="page-header">Add Movies</h1>
		  
	<div class="container col-sm-10">
	  <h2 style="color:blue; font-family:serif;">* Movie Details *</h2>
	  <br>
	  <form class="form-horizontal" role="form">
		<div class="form-group">
		  <label class="control-label col-sm-2">Name :</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" id="movieName" placeholder="What's the name ?" required>
		  </div>
		</div>
		<div class="form-group">
		  <label class="control-label col-sm-2">Description :</label>
		  <div class="col-sm-10">
			<input type="textarea" class="form-control" id="description" placeholder="Tell Me Something about it..." required>
		  </div>
		</div>
		<div class="form-group">
		  <label class="control-label col-sm-2">Trailer link :</label>
		  <div class="col-sm-10">
			<input type="text" class="form-control" id="description" placeholder="Show me the trailer on Youtube...">
		  </div>
		</div>
		<div class="form-group">
		  <label class="control-label col-sm-2">Rating(%) :</label>
		  <div class="col-sm-2">
			<input type="number" min="1" max="100" class="form-control" id="description" placeholder="1 to 100">
		  </div>
		</div>
		<div class="form-group">
		  <div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-success">Submit</button>
		  </div>
		</div>
	  </form>
	</div>

		  
<?php include 'templates/base2.php'; ?>
	</body>
</html>