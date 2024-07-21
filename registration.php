<?php
	include "connection.php";
	include "navbar_2.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Student Registration</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale=1">

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<style type="text/css">
	section
	{
		margin-top: -20px;
	    height: 650px;
	    background-image: url("Images/Image 6.jpg");
	    background-repeat: no-repeat;
	    background-size: cover;
	    background-position: center;
	}
	.box2
	{
	    height: 400px;
	    width: 450px;
	    background-color: deepskyblue;
	    margin: 0px auto;
	    opacity: .8;
	    color: white;
	    padding: 20px;
	    padding-top: 160px;
	    border-radius: 20px;

	}
	label
	{
		font-weight: 600;
		font-size: 18px;
	}
</style>
</head>
<body>

	<section><br><br><br><br>
		<div class="box2">
			
			<form name="signup" action="" method="post">
					<b><p style="padding-left: 50px; font-size: 15px; font-weight: 700;">Sign Up as: </p></b>
					<input style="margin-left: 50px; width: 18px; margin-top: -5px;" type="radio" name="user" id="admin" value="admin">
					<label for="admin">Admin</label>
					<input style="margin-left: 50px; width: 18px; margin-top: -5px;" type="radio" name="user" id="student" value="student">
					<label for="student">Student</label>&nbsp&nbsp&nbsp&nbsp&nbsp

					<button class="btn btn-default" type="submit" name="submit5" style="color: black; font-weight: 700; width: 70px; height: 30px;">Ok</button>
			</form>
		</div>
		<?php
			if(isset($_POST['submit5']))
			{
				if($_POST['user']=='admin')
				{
					?>
				        <script type="text/javascript">
				            window.location="Admin/registration.php";
				        </script>
       				<?php
				}
				else
				{
					?>
				        <script type="text/javascript">
				            window.location="Student/registration.php";
				        </script>
				    <?php
				}
			}
		?>
	</section>
</body>
</html>