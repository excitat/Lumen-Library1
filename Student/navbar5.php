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
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body>

	<?php
		// Database connection
		include "connection.php";

		// Get unread messages count
		$r = mysqli_query($db, "SELECT COUNT(status_read) as total FROM message WHERE status_read='no' AND username='$_SESSION[login_user]' AND sender='admin';");
		$count = mysqli_fetch_assoc($r);

		// Get all approved issued books for the user
		$b = mysqli_query($db, "SELECT * FROM issue_book WHERE username='$_SESSION[login_user]' AND approve='Yes' ORDER BY return_date_time ASC;");
		$books = mysqli_fetch_all($b, MYSQLI_ASSOC);

		// Get the timer data for the first book
		$t = null;
		$timerData = null;
		if (!empty($books)) {
			$t = mysqli_query($db, "SELECT * FROM timer WHERE name='$_SESSION[login_user]' AND bid='{$books[0]['bid']}';");
			$timerData = mysqli_fetch_assoc($t);
		}
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
				if (isset($_SESSION['login_user'])) {
			?>

<!--________________________Timer________________________________-->
<script>
	document.addEventListener('DOMContentLoaded', function(){
// Function to set the countdown timer
function startTimer(countDownDate) {
    var x = setInterval(function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;

        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "EXPIRED";
            document.getElementById("timer-container").style.display = "none";
        } else {
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("demo").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
        }
    }, 1000);
}

// Set countdown for multiple books
<?php if (!empty($books)): ?>
var books = <?php echo json_encode($books); ?>;
var currentBookIndex = 0;

function updateTimer() {
    if (currentBookIndex < books.length) {
        var countDownDate = new Date(books[currentBookIndex]['return_date_time']).getTime();
        document.getElementById("timer-container").style.display = "block";
        startTimer(countDownDate);
        
        // Move to next book once the current countdown ends
        var checkInterval = setInterval(function() {
            if (document.getElementById("demo").innerHTML === "EXPIRED") {
                clearInterval(checkInterval);
                currentBookIndex++;
                console.log("Books data:", books);
                updateTimer();
            }
        }, 1000);
    } else {
        document.getElementById("timer-container").style.display = "";
    }
}

updateTimer();
<?php else: ?>
document.getElementById("timer-container").style.display = "none";
<?php endif; ?>
});
</script>
<!--________________________Timer________________________________-->

				<ul style="margin-top: -4px;" class="nav navbar-nav">
					<li><a href="profile.php" style="color: deepskyblue;">PROFILE</a></li>
					<li><a href="fine.php" style="color: deepskyblue;">FINES</a></li>
				</ul>
				<ul style="margin-top: -10px;" class="nav navbar-nav navbar-right">
					<li><div id="timer-container" style="display: none;">
        <p style="color: #ff1503; font-size: 20px; padding-top: 15px;" id="demo"></p>
    </div></li>
					<li><a href="message.php" style="margin-top: 5px;"><span class="glyphicon glyphicon-envelope"></span><span class="badge"><?php echo $count['total']; ?></span></a></li>
					<li><a href="profile.php">
						<div style="color: deepskyblue; font-size: 20px; margin-top: 0px;">
							<?php
								echo "<img class='img-circle profile_img' height=33 width=33 src='Images/".$_SESSION['pic']."'>";
								echo " ".$_SESSION['login_user'];
							?>
						</div>
					</a></li>
					<li><a href="logout.php" style="color: deepskyblue; margin-top: 4px;"><span class="glyphicon glyphicon-log-out"> LOGOUT </span></a></li>
				</ul>
				<?php
			}
			?>	
		</div>
	</nav>
	<?php
		if (isset($_SESSION['login_user'])) {
			$day = 0;
			$expire = '<p style="color:yellow; background-color:red;">EXPIRED</p>';
			$x = mysqli_query($db, "SELECT return_date_time FROM issue_book WHERE username ='$_SESSION[login_user]' AND approve = '$expire';");
			while ($row = mysqli_fetch_assoc($x)) {
				$d = strtotime($row['return_date']);
				$c = strtotime(date("Y-m-d H:i:s"));
				$diff = $c - $d;

				if ($diff >= 0) {
					$day += floor($diff / (60 * 60 * 24));
				} //Days without returning book
			}
			$_SESSION['fine'] = $day * 100;
		}
	?>

</body>
</html>
