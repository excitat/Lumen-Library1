<?php
	include "connection.php";
	include "navbar_2.php";
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';  // Adjust the path to your vendor/autoload.php

    function sendEmail($to, $subject, $msg, $from) {
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
            $mail->SMTPAuth = true;
            $mail->Username = 'makondi.junior@gmail.com';  // SMTP username
            $mail->Password = 'gdlt ibdh pxgv bsgh';  // SMTP password
            $mail->SMTPSecure = 'tls';  // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587;  // TCP port to connect to

            //Recipients
            $mail->setFrom($from, 'Lumen Library Notification');
            $mail->addAddress($to);  // Add a recipient

            //Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $msg;
            $mail->AltBody = strip_tags($msg);

            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Student Registration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale=1">


<style type="text/css">
	section
	{
		margin-top: -20px;
	}
</style>
</head>
<body>

	<section>
		<div class="registration_img">
			<br>
			<div class="box2" style="border-radius: 20px;">
					<h1 style="text-align: center; font-size: 35px; font-family: Lucida Console;">Lumen Library</h1>
					<h1 style="text-align: center; font-size: 25px;">Registration Form</h1><br>
				<form name="registration" action="" method="POST">
					<div class="registration">
						<input class="form-control" type="text" name="firstname" placeholder="First Name" required=""><br>
						<input class="form-control" type="text" name="lastname" placeholder="Last Name" required=""> <br>
						<input class="form-control" type="text" name="username" placeholder="Username" required=""> <br>
						<input class="form-control" type="text" name="matricule" placeholder="Matricule No" required=""><br>
						<input class="form-control" type="email" name="email" placeholder="Email" required=""> <br>
						<input class="form-control" id="contact" type="text" name="contact" placeholder="Phone No" required=""> <br>
						<input class="form-control" type="password" name="password" placeholder="Password" required=""> <br>
						<input class="btn btn-default" type="submit" name="submit" value="Sign Up" style="color: black; width: 70px; height: 30px;">

					</div>
				</form>
			
			</div>

			
		</div>
</section>

    <?php

		if(isset($_POST['submit']))
		{
				$count=0;
				$sql="SELECT username from student";
				$res=mysqli_query($db,$sql);

				while($row=mysqli_fetch_assoc($res))
				{
					if($row['username']==$_POST['username'])
					{
						$count=$count+1;
					}
				}
			if($count==0)
			{
				mysqli_query($db,"INSERT INTO student VALUES('$_POST[firstname]', '$_POST[lastname]', '$_POST[username]', '$_POST[matricule]', '$_POST[email]', '0', '$_POST[contact]', '$_POST[password]', 'Image1.jpeg');");
				$otp=rand(10000,99999);
				$date=date("Y-m-d");
				mysqli_query($db, "INSERT INTO verify VALUES('$_POST[username]', '$otp', '$date');");

				$msg="Hello your Verification code is: ".$otp.".";
				$from="makondi.junior@gmail.com";

				if(sendEmail($_POST['email'], "Verification Code", $msg, $from))
				{
					?> 
						<script type="text/javascript">
							alert("Registration Successful");
							window.location="../verify.php"
						</script>
					<?php
				}
				else
				{

					?>
						<script type="text/javascript">
							alert("Email not sent.");
						</script>
					<?php
				}

		    }

				else
				{

					?>
						<script type="text/javascript">
							alert("This User already exists");
						</script>
					<?php
				}
		}
		

		
?>
</body>
</html>

$otp=rand(10000,99999);
	echo $otp;