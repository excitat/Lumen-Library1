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

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

	<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div class="navbar-header"> 
						<a class="navbar-brand active">LUMEN LIBRARY MANAGEMENT SYSTEM</a>
					</div>

					<ul class="nav navbar-nav">
						<li><a href="index.php" style="color: deepskyblue;">HOME</a></li>
						<li><a href="books.php" style="color: deepskyblue;">BOOKS</a></li>
						<li><a href="feedback.php" style="color: deepskyblue;">FEEDBACK</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li><a href="index.php" style="color: deepskyblue;"><span class="glyphicon glyphicon-log-out"> LOGOUT </a></li>
						<li><a href="registration.php" style="color: deepskyblue;"><span class="glyphicon glyphicon-user"> SIGN-UP </a></li>
						
					</ul>
				</div>
			</nav>

</body>
</html>