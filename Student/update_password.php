<?php
	include "connection.php";
	include "navbar3.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Change Password</title>

	<style type="text/css">
		body
		{
			height: 650px;
			background-image: url("Images/password1.jpeg");
		}
		.wrapper
		{
			width: 400px;
			height: 400px;
			margin: 100px auto;
			background-color: white;
			opacity: .9;
			border-radius: 20px;
			padding: 5px 15px;
			color: black;
		}
		.form-control
		{
			width: 260px;
			margin-left: 60px;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<div style="text-align: center;">
				<h1 style="text-align: center; font-size: 35px; font-family: Lucida Console;">Change your Password</h1>
				<h1 style="text-align: center; font-size: 15px; font-family: Lucida Console;">Have you forgotten your password ?</h1>
			
		</div><br>

		<form action="" method="post">
			<input type="text" name="username" class="form-control" placeholder="Enter your username" required=""><br>
			<input type="text" name="email" class="form-control" placeholder="Enter your email address" required=""><br>
			<input type="text" name="password" class="form-control" placeholder="Enter your new password" required=""><br>
			<button style="margin-left: 60px;" class="btn btn-default" type="submit" name="submit">Update</button>

		</form>
		
	
	<?php

		if(isset($_POST['submit']))
		{
			$username = mysqli_real_escape_string($db, $_POST['username']);
			$email = mysqli_real_escape_string($db, $_POST['email']);
			$password = mysqli_real_escape_string($db, $_POST['password']);

			$query = "UPDATE student SET password='$password' WHERE username='$username' AND email='$email'";
			
			if(mysqli_query($db, $query))
			{
				echo "<script type='text/javascript'>alert('Password updated Successfully');
				window.location='student_login.php'
				</script>";
			}
			else
			{
				echo "<script type='text/javascript'>alert('Error updating password: " . mysqli_error($db) . "');</script>";
			}
		}
		?>
	</div>

</body>
</html>