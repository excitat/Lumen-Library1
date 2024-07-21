<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Lumen Library Management System</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale=1">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style type="text/css">
	nav
	{
	    float: right;
	    word-spacing: 20px;
	}
	nav li
	{
	    display: inline-block;
	    line-height: 100px;
	}
	</style>
</head>

<body>
	<div class="wrapper">
	
		<header style="height: 100px; background-color: white;">
		<div class="logo">	
			<img src="Images/Image 3.jpeg">
			<h3 style="color: deepskyblue; padding-top: 10px;">LUMEN LIBRARY MANAGEMENT SYSTEM</h3>
		</div>


		<?php
		if(isset($_SESSION['login_user']))
		{
			?>
				<nav>
					<ul>
						<li><a href="">
									<div style="color: deepskyblue; font-size: 20px; word-spacing: 0px; display: inline-block;">
										<?php
											echo "Welcome ".$_SESSION['login_user'];
										?>
									</div>
								</a></li>
						<li><a href="profile.php" style="color: deepskyblue;">PROFILE</a>
						</li>

						<li><a href="books.php" style="color: deepskyblue;">BOOKS</a></li>	
						<li><a href="feedback.php" style="color: deepskyblue;">FEEDBACK</a></li>
						<li><a href="logout.php" style="color: deepskyblue;">LOGOUT</a></li>
					</ul>
				</nav>
			<?php
		}
		else 
		{?>
				<nav>
					<ul style="margin-right: 20px;">
						<li><a href="login.php" style="color: deepskyblue;"><span class="glyphicon glyphicon-log-in">&nbspLOGIN</span></a></li>
					</ul>
				</nav>
		<?php
			
		}

		?>

			
		</header>
		<section>
			<div class="section_img">
			<br><br><br>
				<div class="box" style="border-radius: 20px;"> <br>
					<h1 style="text-align: center; font-size: 35px;">Welcome to Lumen</h1> <br>
					<h1 style="text-align: center; font-size: 20px;">Opens at: 08:00 a.m</h1> <br><br>
					<h1 style="text-align: center; font-size: 20px;">Closes at: 05:00 p.m</h1>
				</div>
			</div>
		</section>

	</div>
	<?php
		include "footer.php";
	?>
</body>
</html>