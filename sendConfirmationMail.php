<?php
require 'PHPmailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'FWRsmtp@gmail.com';          // SMTP username
$mail->Password = 'FWR_admin'; // SMTP password
$mail->SMTPSecure = 'tls';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                          // TCP port to connect to

$mail->setFrom('noreply@fwr.com', 'Friends With Ratings');
$mail->addAddress($email);   // Add a recipient

$mail->isHTML(true);  // Set email format to HTML

//Make unique code
$count=1;
while($count!=0){
$code=md5(uniqid(rand()));
$sql = "SELECT admin FROM waiting WHERE code = '$code'";
$count = mysqli_num_rows(mysqli_query($db, $sql));
}
		
$bodyContent  = '<h1>Hello, '.$_POST['name'].'<br>Thank you for joining us!</h1>';
$bodyContent .= '<p><b>Username : '.$_POST['userName'].'<br>';
$bodyContent .= '<b>Password : '.$_POST['password1'].'</p>';
$bodyContent .= '<p>Click the following confirmation link to set up your account at FWR !<br><b>We will see you there :) - FWR</b></p>';
$bodyContent .= '<p>CONFIRM you are one of us --->&nbsp; http://localhost/MyPhpFiles/FWR/confirmMail.php?code='.$code.'</p>';

$mail->Subject= 'Account Confirmation FWR';
$mail->Body   = $bodyContent;

if(!$mail->send()) {
    throw new Exception("Couldn't send mail...Please,Try again!");
} else {
	/* Add in waiting List*/
	$db->query("INSERT INTO waiting (code,name,email,username,password,admin)VALUES ('$code','$name','$email','$userName','$password1','$admin')");
	
	/* Activate Modal at the End */
	$success=1;
}
?>