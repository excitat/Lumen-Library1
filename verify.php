<?php 
	include "connection.php";
	include "navbar_2.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Verify email address</title>

	<style type="text/css">
		.box1
		{
		    height: 500px;
		    width: 400px;
		    background-color: deepskyblue;
		    margin: 0px auto;
		    opacity: .8;
		    color: white;
		    padding: 20px;
		    border-radius: 30px;
		    padding-top: 150px;
		}
	</style>
</head>
<body style="background-color: #d8e3e2;">
	<div class="box1">
		<h2>Enter the OTP:-</h2><br>
		<form method="post">
			<input style="width: 300px; height: 45px;" type="text" name="otp" class="form-control" required="" placeholder="Enter the OTP here..."><br>
			<button class="btn btn-default" name="submit_v" style="font-weight: 700;">Verify</button>
		</form>
	</div>
<?php
	if(isset($_POST['submit_v']))
	{
		$ver2=mysqli_query($db,"SELECT * FROM verify;");
		while($row=mysqli_fetch_assoc($ver2))
		{
			if($_POST['otp']==$row['otp'])
			{
				mysqli_query($db,"UPDATE student set status='1' where username='$row[username]' ;");
				$ver1=$ver1+1;
			}
		}
		if($ver1==1)
		{
			header("location:login.php");
		}
		else
		{
			?>
			<script type="text/javascript">
				alert("Wrong OTP given. Try again.");
			</script>
			<?php
		}
	}
?>
</body>
</html>