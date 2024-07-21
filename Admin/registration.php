,<?php
	include "connection.php";
	include "navbar_2.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Admin Registration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale=1">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style type="text/css">
	section
	{
		margin-top: -20px;
	}
	.form-control
	{
		color: black;
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
						<input class="form-control" type="text" name="email" placeholder="Email" required=""> <br>
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
				$sql="SELECT username from admin";
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
				mysqli_query($db,"INSERT INTO admin VALUES('', '$_POST[firstname]', '$_POST[lastname]', '$_POST[username]', '$_POST[email]', '$_POST[contact]', '$_POST[password]', 'Image1.jpeg', '');");	

	?> 
					<script type="text/javascript">
						alert("Registration Successful, Wait for Approval");
						window.location="../login.php"
					</script>
				<?php
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