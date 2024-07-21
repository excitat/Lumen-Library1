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
		$r=mysqli_query($db,"SELECT COUNT(status_read) as total FROM message where status_read='no' and username='$_SESSION[login_user]' and sender='admin' ;");

		$count=mysqli_fetch_assoc($r);
		//---------------Timer-------
		 $b = mysqli_query($db, "SELECT * FROM issue_book WHERE username='$_SESSION[login_user]' AND approve='Yes' ORDER BY return_date ASC LIMIT 0,1");
		$bid=mysqli_fetch_assoc($b);

		$t=mysqli_query($db,"SELECT * from timer where name='$_SESSION[login_user]' and bid='$bid[bid]' ;");
		$res=mysqli_fetch_assoc($t);
	?>

	<nav class="navbar navbar-inverse">
				<div class="container-fluid">
					<div style="padding-top: 15px;" class="navbar-header"> 
						<a class="navbar-brand active">LUMEN LIBRARY MANAGEMENT SYSTEM</a>
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

<!--________________________Timer________________________________-->
<script>
// Set the date we're counting down to
var countDownDate = new Date("<?php echo $res['tm']; ?>").getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();

  // Find the distance between now and the count down date
  var distance = countDownDate - now;

  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

  // Display the result in the element with id="demo"
  document.getElementById("demo").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";

  // If the count down is finished, write some text
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("demo").innerHTML = "EXPIRED";
  }
}, 1000);
</script>
<!--________________________Timer________________________________-->


							<ul style="margin-top: -4px;" class="nav navbar-nav">
								
								<li><a href="profile.php" style="color: deepskyblue;">PROFILE</a></li>
								<li><a href="fine.php" style="color: deepskyblue;">FINES</a></li>
							</ul>
							<ul style="margin-top: -10px;" class="nav navbar-nav navbar-right">
								<li><a><p style="color: #ff1503; font-size: 20px;" id="demo"></p></a></li>
								<li><a href="message.php" style="margin-top: 5px;"><span class="glyphicon glyphicon-envelope"></span><span class="badge"><?php echo $count['total']; ?></span> </li>
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