        </div>
      
	  </div>
    </div>
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function()
		{	
			$(document).on('submit', '#fbform', function()
			{
				var msg = $("#tamsg").val();
				$("#tamsg").val('');
				var data = 'tamsg='+msg;//+'&lname='+ln;
				//var data = $(this).serialize();
				
				$.post("sendfeedback.php",{tamsg:msg},
					function(data){		
						$("#myModal").modal('hide');
						$(".alert").show();
						window.setTimeout(function(){$(".alert").hide(1500);},3000);
				});
				return false;
			});
		});
	</script>