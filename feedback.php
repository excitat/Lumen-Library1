<?php
	include "connection.php";
	include "navbar4.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Feedback</title>

	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale=1">


<style type="text/css">
	body{
		background-image: url("Images/Image2.jpeg");
		background-size: cover;
		background-repeat: no-repeat;
	}
	.wrapper
	{
		padding: 10px;
		margin: -20px auto;
		width: 800px;
		height: 650px;
		background-color: black;
		opacity: .8;
		color: white;
	}
	.form-control
	{
		margin-left: 50px;
		height: 90px;
		width: 70%;
	}
	.scroll
	{
		width: 100%;
		height: 300px;
		overflow: auto;
	}
	.btn
	{
		margin-left: 60px;
	}

</style>

</head>
<body>
	<div class="wrapper">
		<h3 style="text-align: center;">If you have any suggestions or questions please comment below</h3> <br><br>
		<form style="" action="" method="post">
			<input class="form-control" type="text" name="comment" placeholder="Please write a comment..."> <br>
			<input class="btn btn-default" type="submit" name="submit3" value="Submit" style="width: 100px; height: 30px;">
			
		</form> 
		<br><br>

		<div class="scroll">
			<?php
				if(isset($_POST['submit3']))
				{
					$sql="INSERT INTO comments VALUES('','$_SESSION[login_user]', '$_POST[comment]');";
					if(mysqli_query($db,$sql))
					{
						$q="SELECT * FROM comments ORDER BY id DESC";
						$res=mysqli_query($db,$q);

						echo "<table class='table table-bordered'>";
						while($row=mysqli_fetch_assoc($res))
						{
							echo "<tr>";
								echo "<td>"; echo $row['username']; echo "</td>";
								echo "<td>"; echo $row['comment']; echo "</td>";
							echo "</tr>";
						}

					}

				}
				else
				{
					$q="SELECT * FROM comments ORDER BY id DESC";
						$res=mysqli_query($db,$q);

						echo "<table class='table table-bordered'>";
						while($row=mysqli_fetch_assoc($res))
						{
							echo "<tr>";
								echo "<td>"; echo $row['username']; echo "</td>";
								echo "<td>"; echo $row['comment']; echo "</td>";
							echo "</tr>";
						}
				}
			?>
		</div>
	</div>


</body>
</html>