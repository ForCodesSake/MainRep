<!DOCTYPE html>
<html lang="en">
	<head>
<?php include 'templates/commonHead.php'; ?>
		<title>About Us</title>
		
    <!-- Custom styles for this template -->
		<link href="css/about.css" rel="stylesheet">

	</head>

	<body onload="myFunction()">
<?php include 'templates/base1.php'; ?>
		
		<h1 class="page-header">About Us</h1>

          <div class="row placeholders">
            <div id="myDiv1" class="col-xs-4 placeholder animate-bottom">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive">
              <h4>Vedanshu Dahiya</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div id="myDiv2" class="col-xs-4 placeholder animate-bottom">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive">
              <h4>Shubham Verma</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div id="myDiv3" class="col-xs-4 placeholder animate-bottom">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive">
              <h4>Gaurav Kumar Rawat</h4>
              <span class="text-muted">Something else</span>
            </div>
          </div>
<?php include 'templates/base2.php'; ?>

<script>
		function myFunction() {
			setTimeout(showPage1, 200);
			setTimeout(showPage2, 400);
			setTimeout(showPage3, 600);
		}

		function showPage1() {
		  document.getElementById("myDiv1").style.display = "block";
		}
		function showPage2() {
		  document.getElementById("myDiv2").style.display = "block";
		}
		function showPage3() {
		  document.getElementById("myDiv3").style.display = "block";
		}
	</script>

	</body>
</html>