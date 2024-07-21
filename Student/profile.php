<?php
	include "connection.php";
	include "navbar4.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profile</title>

	<style type="text/css">
	.box4
	{
	    height: 450px;
	    width: 500px;
	    background-color: black;
	    margin: 15px auto;
	    opacity: .6;
	    color: white;
	    padding: 20px;
	    border-radius: 30px;
	}
	</style>

</head>
<body style="background-image: url(Images/profile2.jpeg); background-repeat: no-repeat; background-size: cover;">

	<div>
		<?php

			$q=mysqli_query($db,"SELECT * FROM student where username='$_SESSION[login_user]';");

		?>

		<?php
			$row=mysqli_fetch_assoc($q);

			echo "<div style='text-align: center'>
			<img class='img-circle profile-img' height=90 width=90 src='Images/".$_SESSION['pic']."'>

			</div>";

		?>

		<div style="text-align: center; font-size: 22px; color: black;"> 

				<b><?php echo $_SESSION['login_user']; ?></b>

		</div>


	</div>

	<div class="box4">
		<form action="" method="post">
			<h2 style="text-align: center; margin-left: 0px;">My Profile</h2> <br><br>

		<?php
			echo "<b>";
			echo "<table style='margin-top: -10px;' class='table table-bordered'>";
				echo "<tr>";
					echo "<td>";
						echo "<b>First Name: </b>";
					echo "</td>";

					echo "<td>";
						echo $row['firstname'];
					echo "</td>";

				echo "</tr>";

				echo "<tr>";
					echo "<td>";
						echo "<b>Last Name: </b>";
					echo "</td>";

					echo "<td>";
						echo $row['lastname'];
					echo "</td>";

				echo "</tr>";

				echo "<tr>";
					echo "<td>";
						echo "<b>Matricule No:  </b>";
					echo "</td>";

					echo "<td>";
						echo $row['matricule'];
					echo "</td>";

				echo "</tr>";

				echo "<tr>";

					echo "<td>";
						echo "<b>Email Address:  </b>";
					echo "</td>";

					echo "<td>";
						echo $row['email'];
					echo "</td>";

				echo "</tr>";

				echo "<tr>";

					echo "<td>";
						echo "<b>Phone No: </b>";
					echo "</td>";

					echo "<td>";
						echo $row['contact'];
					echo "</td>";

				echo "</tr>";


			echo "</table>";
			echo "</b>";
		?>
			<button class="btn btn-default" style="float: right; width: 70px; margin-top: 10px;" name="submit">Edit</button>	
		</form>
		<div class="wrapper">
			<?php
				if(isset($_POST['submit']))
				{
					?>
					<script type="text/javascript">
						window.location="edit.php";
					</script>
					<?php
				}


				$q=mysqli_query($db,"SELECT * FROM student where username='$_SESSION[login_user]' ;");
			?>
		</div>
		
	</div>
	
</body>
</html>