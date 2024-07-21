<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale=1">

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

</head>
<body>
	<?php
		$r=mysqli_query($db,"SELECT COUNT(status_read) as total FROM message where status_read='no' and sender='student' ;");
		$count=mysqli_fetch_assoc($r);

		$sql5=mysqli_query($db,"SELECT COUNT(status) as total FROM admin where status='' ;");
		$a=mysqli_fetch_assoc($sql5);

	?>

	<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div style="padding-top: 15px;" class="navbar-header"> 
						<a class="navbar-brand active">LUMEN LIBRARY</a>
					</div>

					<ul style="padding-top: 15px;" class="nav navbar-nav">
						<li><a href="index.php" style="color: deepskyblue;">HOME</a></li>
						<li><a href="books.php" style="color: deepskyblue;">BOOKS</a></li>
						<li><a href="feedback.php" style="color: deepskyblue;">FEEDBACK</a></li>
					</ul>
					<br>
					<?php
						if(isset($_SESSION['login_user']))
						{?>
							<ul style="margin-top: -4px;" class="nav navbar-nav">
								<li><a href="profile.php" style="color: deepskyblue;">PROFILE</a></li>
							</ul>
							<ul style="margin-top: -3px;" class="nav navbar-nav">
								<li><a href="student.php" style="color: deepskyblue;"> STUDENT-INFORMATION </a></li>
								<li><a href="fine.php" style="color: deepskyblue;">FINES</a></li>
							</ul>
							<ul style="margin-top: -10px;" class="nav navbar-nav navbar-right">

								<li><a href="admin_status.php" style="margin-top: 5px;"><span class="glyphicon glyphicon-user"><span class="badge"><?php echo $a['total']; ?></span></span></a></li>

								<li><a href="message.php" style="margin-top: 5px;"><span class="glyphicon glyphicon-envelope"></span><span class="badge bg-red"><?php echo $count['total']; ?></span> </li>

								<li><a href="profile.php">
									<div style="color: deepskyblue; font-size: 20px; margin-top: -35px;">
										<?php
											echo "<img class='img-circle profile_img' height=33 width=33 src='Images/".$_SESSION['pic']."'>";
											echo " ".$_SESSION['login_user'];
										?>
									</div>
								</a></li>
								<li><a href="logout.php" style="color: deepskyblue; margin-top: 4px;"><span class="glyphicon glyphicon-log-out"> LOGOUT </a></li>

							
							</ul>
							<?php
						}

						?>	
				</div>
	</nav>

</body>
</html>