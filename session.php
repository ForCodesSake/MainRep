<?php
   include('config.php');
   session_start();
   
   if(!isset($_SESSION['login_user'])){
      header("location:login.php");
   }
   
   if(!isset($_SESSION['updated'])||$_SESSION['updated']!=1){
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select * from users where username = '$user_check'");   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   if(mysqli_num_rows($ses_sql)==0){
	   session_destroy();
	   header('location:login.php');
   };
   
   /* checking is user is Admin or not */
   $_SESSION['admin'] = $row['admin'];
   $_SESSION['id'] = $row['id']; 
   $_SESSION['name'] = $row['name'];
   $_SESSION['email'] = $row['email'];
   $_SESSION['username']= $row['username'];
   $_SESSION['updated']=1;
   }
   mysqli_close($db);
?>