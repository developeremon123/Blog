<?php 
	include '../lib/Session.php';
	Session::checkLogin();
?>
<?php include '../config/config.php';?>
<?php include '../lib/Database.php';?>
<?php include '../helpers/Format.php';?>
<?php 
$db = new Database;
$fm = new Format;
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Recovery Password</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
	<?php 
	if ($_SERVER["REQUEST_METHOD"] == 'POST') {
		$email = $fm->validation($_POST['email']);
		$email = mysqli_real_escape_string($db->link,$email);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "<span style='color:red;font-size:18px;'>Invalid Email Address!!!</span>";
		}else {
        $mailquery = "SELECT * FROM tbl_user WHERE email = '$email' LIMIT 1";
        $mailcheck = $db->select($mailquery);

		
		if ($mailcheck != false) {
			while ($value = $mailcheck->fetch_assoc()) {
                $userid   = $value['id'];
                $username = $value['username'];
            }

            $text     = substr($email, 0, 3);
            $rand     = rand(10000, 99999);
            $newpass  = "$text$rand";
            $password = $newpass;

            $updatequery = "UPDATE tbl_user SET password = '$password' WHERE id = '$userid'";
            $update_row  = $db->update($updatequery);

            $to_mail    = $email;
            $from       = "usskyjraks@gmail.com";
            $header     = "From: ".$from ;
            $header    .= "MIME-Version: 1.0 \r\n";
            $header    .= "Content-type: text/html; charset=iso-8859-1. \r\n";
            $subject    = "Your Password";
            $message    = "Your Username is".$username." and Password is ".$newpass." Please visit website to login.";
            
            $sendmail = mail($to_mail,$subject,$message,$header);
            if ($sendmail) {
                echo "<span style='color:green;font-size:18px;'>Forget Password Successfully</span>";
            }else {
                echo "<span style='color:red;font-size:18px;'>Something Went Wrong!!</span>";
            }

			} else {
			echo "<span style='color:red;font-size:18px;'>Your email addess not exist!!</span>";
		}
	}
}
	?>
		<form action="" method="post">
			<h1>Recovery Password</h1>
			<div>
				<input type="text" placeholder="Enter email address" required="" name="email"/>
			</div>
			
			<div>
				<input type="submit" value="Send" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Login</a>
		</div><!-- button -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>