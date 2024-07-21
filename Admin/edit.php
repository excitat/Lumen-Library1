<?php
	include "connection.php";
	include "navbar4.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Profile</title>

	<style type="text/css">
	.box3
	{
	    height: 600px;
	    width: 500px;
	    background-color: black;
	    margin: 15px auto;
	    opacity: .6;
	    color: white;
	    padding: 20px;
	    border-radius: 30px;
	}
	.form-control
	{
		width: 230px;
		height: 37px;
		color: black;
		

	}
	form
	{
		padding-left: 120px;

	}
	.btn:hover
	{
		background-color: deepskyblue;
	}
	</style>
</head>
<body style="background-image: url(Images/profile2.jpeg); background-repeat: no-repeat; background-size: cover;">

<div class="box3">
	

	<h2 style="text-align: center; margin-left: 0px;">Edit Information</h2> <br>

	<?php
		$sql = "SELECT * FROM admin WHERE username='$_SESSION[login_user]' ";
		$result = mysqli_query($db,$sql) or di (mysql_error());

		while ($row = mysqli_fetch_assoc($result)) 
		{
			$email=$row['email'];
			$contact=$row['contact'];

		}
	?>

	<div class="profile_info" style="text-align: center;">
		<span style="color: white;">Welcome,</span>
		<h4 style="color: white;"><?php echo $_SESSION['login_user']; ?></h4></div>
	<form action="" method="post" enctype="multipart/form-data">

		
		<label><h4 style="font-size: 12px;"><b>Email Address: </b></h4></label>
		<input class="form-control" type="text" name="email" value="<?php echo $email;?>"><br>
		<label><h4 style="font-size: 12px;"><b>Phone No: </b></h4></label>
		<input class="form-control" type="text" name="contact" value="<?php echo $contact;?>"><br>
		<label><h4 style="font-size: 12px;"><b>Picture: </b></h4></label>
		<input class="form-control" type="file" name="file"><br><br>
		<div style="color: black; padding-left: 90px;"><button style="color: black;" class="btn btn-default" type="submit" name="submit" >Save</button></div>

	</form>
</div>
	<?php

		if(isset($_POST['submit']))
		{
			move_uploaded_file($_FILES['file']['tmp_name'], "Images/".$_FILES['file']['name']);

			$email=$_POST['email'];
			$contact=$_POST['contact'];
			$pic=$_FILES['file']['name'];


			$sql1= "UPDATE admin SET pic='$pic', email='$email', contact='$contact' WHERE username='".$_SESSION['login_user']."';";

			if(mysqli_query($db,$sql1))
			{
				?>
					<script type="text/javascript">
						alert("Profile Saved Successfully.");
						window.location="profile.php";
					</script>

				<?php

			}
		}

	?>

</body>
</html>