<?php
	include "connection.php";
	include "navbar3.php";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width-device-width, initial-scale=1">

	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<style type="text/css">
	section
	{
		margin-top: -20px;
	}
	.box1
{
    height: 500px;
    width: 400px;
    background-color: deepskyblue;
    margin: 30px auto;
    opacity: .8;
    color: white;
    padding: 20px;
    border-radius: 30px;
}
label
{
	font-size: 18px;
	font-weight: 600;
}
</style>
</head>
<body>

	<section>
		<div class="login_img">
			<br><br><br>
			<div class="box1" style="border-radius: 20px;">
					<h1 style="text-align: center; font-size: 35px; font-family: Lucida Console;">Lumen Library</h1>
					<h1 style="text-align: center; font-size: 25px;">Login Form</h1><br>
				<form name="login" action="" method="post">
					<b><p style="padding-left: 50px; font-size: 15px; font-weight: 700;">Login as: </p></b>
					<input style="margin-left: 50px; width: 18px; margin-top: -5px;" type="radio" name="user" id="admin" value="admin">
					<label for="admin">Admin</label>
					<input style="margin-left: 50px; width: 18px; margin-top: -5px;" type="radio" name="user" id="student" value="student">
					<label for="student">Student</label>
					<br>
					<div class="login">
						<input class="form-control" type="text" name="username" placeholder="Username" required=""> <br>
						<input class="form-control" type="password" name="password" placeholder="Password" required=" "> <br>
						<input class="btn btn-default" type="submit" name="submit2" value="Login" style="color: black; width: 70px; height: 30px;">
					</div>
				
				<p style="color: white; padding-left: 20px;"> <br><br>
					<a style="color: white;" href="update_password.php">Forgot password?</a>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
					New to this website?<a style="color: white;" href="registration.php">Sign Up</a>
				</p>
			</form>
			
			</div>

			
		</div>
	</section>

		<?php
if (isset($_POST['submit2'])) 
{

	if($_POST['user']=='admin')
	{
		$count = 0;
    
    // Check the connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Properly format the SQL query using backticks
    $sql = "SELECT * FROM `admin` WHERE username='$_POST[username]' AND password='$_POST[password]' and status='Yes' ;";
    $res = mysqli_query($db, $sql);
    
    // Check if the query was successful
    if (!$res) {
        die("Query failed: " . mysqli_error($db));
    }

    $row= mysqli_fetch_assoc($res);

    $count = mysqli_num_rows($res);

    if ($count == 0) {
        ?>
        <script type="text/javascript">
            alert("The user is not yet approved");
        </script>
        
        <?php 
    } 
    else
    {
    	/*.......................If username and password matches..............*/
    	$_SESSION['login_user'] = $_POST['username'];
    	$_SESSION['pic'] = $row['pic'];
    	$_SESSION['username']='';
        ?>
        <script type="text/javascript">
            window.location="Admin/profile.php";
        </script>
        <?php
    }
	}
	else
    {
        $count = 0;
    
    // Check the connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    // Properly format the SQL query using backticks
    $sql = "SELECT * FROM `student` WHERE username='{$_POST['username']}' AND password='{$_POST['password']}'";
    $res = mysqli_query($db, $sql);
    
    // Check if the query was successful
    if (!$res) {
        die("Query failed: " . mysqli_error($db));
    }
    $row= mysqli_fetch_assoc($res);
    
    $count = mysqli_num_rows($res);

    if ($count == 0) {
        ?>
        <script type="text/javascript">
            alert("The username or password is incorrect");
        </script>
        
        <!--<div class="alert alert-danger" style="width: 700px; margin-left: 300px;">
            <strong>The username or password is incorrect</strong>
        </div>-->
        <?php 
    } 
    else
    {
    	/*.......................If username and password matches..............*/

        if($row['status']==1)
        {


        	$_SESSION['login_user'] = $_POST['username'];
        	$_SESSION['pic'] = $row['pic'];
            ?>
            <script type="text/javascript">
                window.location="Student/profile.php";
            </script>
            <?php
        }
        else
        {
            ?>
            <script type="text/javascript">
                alert("Verify your email by OTP before login");
            </script>
            <?php
        }
    }
}
}
?>

</body>
</html>