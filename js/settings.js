$(document).ready(function() {  
	$("#form1").submit(function(e) {
    e.preventDefault();
	});	
	
	$("#form2").submit(function(e) {
    e.preventDefault();
	});	
	
	$("#form3").submit(function(e) {
    e.preventDefault();
	});	
		
	$('#newUsername').keyup(function(){  
		$('#notif2').html("<span style='color:blue;'>Checking...</span>");
		window.setTimeout(function(){check_availability()},350);
	}); 

	$('#newName').keyup(function(){   
		var newName=$('#newName').val();
		
		if(newName=='')
			$('#notif1').html("<span style='color:darkred;'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i>&nbsp;\"A Man has No Name!\"</span>");  
	});  
	
	$(document).on('submit', '#form1', function(){
		var newName=$('#newName').val();
		$.post("settingsUpdate.php", { set:1,newName: newName },  
		function(result){  
			$('#notif1').html("<span style='color:green;'><i class='fa fa-check' aria-hidden='true'></i>UPDATED! Hey,Look at new you!</span>");
			$('#helloName').html(escapeHtml(newName));
		});	
	});
		
	$(document).on('submit', '#form2', function(){
		var newUsername=$('#newUsername').val();
		
		$.post("settingsUpdate.php",{ set:2,newUsername: newUsername },  
		function(result){  
			if(result!='')
			$('#notif2').html(result);  
		});	
	});
	
	$(document).on('submit', '#form3', function(){
		var currPassword=$('#currPassword').val();
		var Pass1=$('#password1').val();
		var Pass2=$('#password2').val();
		if(Pass1!=Pass2){
			$('#notif3').html("<span style='color:darkred;'><i class='fa fa-exclamation-triangle' aria-hidden='true'></i>PASSWORDs don't Match!</span>");  
		}
		else
		$.post("settingsUpdate.php", { set:3,currPassword: currPassword,newPassword:Pass1},  
		function(result){  
			$('#notif3').html(result);  
		});	
	});
				
});  
  
//function to check username availability  
function check_availability(){  

	var newUsername = $('#newUsername').val();  
	
	if(newUsername==''){
		$('#notif2').html('<span style="color:darkred;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;"A Man has No UserName !?!"</span>');  
	}
	else
	//use ajax to run the check  
	$.post("usernameCheck.php", { newUsername: newUsername },  
		function(result){  
			if(result == 1){
				$('#notif2').html("<span style='color:green;'><i class='fa fa-check' aria-hidden='true'></i>AVAILABLE...In Stock :p</span>");  	
			}else{  
			$('#notif2').html('<span style="color:darkred;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>Username Not Available... Not Our Lucky Day,is it ?</span>');  
			}
	});  
}  

function escapeHtml(unsafe) {
    return unsafe
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
 }