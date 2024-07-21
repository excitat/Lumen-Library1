<?php
    include "connection.php";
    include "navbar4.php";
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Messages</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        body {
            background-image: url(Images/message2.jpeg);
            background-repeat: no-repeat;
            background-size: cover;
        }
        .wrapper {
            height: 600px;
            width: 500px;
            background-color: black;
            opacity: .9;
            margin: -20px auto;
            padding: 5px;
        }
        .form-control {
            height: 46px;
            width: 77%;
        }
        .msg {
            height: 470px;
            overflow-y: scroll;
        }
        .btn-info {
            background-color: #41a7fb;
        }
        .chat {
            display: flex;
            flex-flow: row nowrap;
            align-items: center;
            margin-bottom: 10px; /* Add some spacing between chat messages */
        }
        .user .chatbox {
            height: 50px;
            width: 386px;
            padding: 13px 10px;
            background-color: #c552db;
            border-radius: 10px;
            order: 0; /* Ensure the chatbox is first in order */
            margin-left: 10px;
        }
        .profile_img_container {
            order: 1; /* Ensure the profile image is second in order */
            margin-left: 10px; /* Add some spacing between the chatbox and the profile image */
        }
        .profile_img {
            border-radius: 50%;
        }
        .admin .chatbox1 {
            height: 50px;
            width: 390px;
            padding: 13px 10px;
            background-color: #231d21;
            border-radius: 10px;
            order: 1; /* Ensure the chatbox is second in order */
            margin-left: 10px; /* Add some spacing between the profile image and the chatbox */
        }
        .profile_img_container1 {
            order: 0; /* Ensure the profile image is first in order */
            margin-left: 0; /* Remove additional spacing */
        }
    </style>
</head>
<body>
    <?php
        if(isset($_POST['submit'])) 
        {
            mysqli_query($db,"INSERT INTO message (username, message, status_read, sender) VALUES ('$_SESSION[login_user]', '$_POST[message]', 'no', 'student')");
        }
        	$result = mysqli_query($db,"SELECT * FROM message WHERE username='$_SESSION[login_user]' ;");

        	mysqli_query($db,"UPDATE message set status_read='yes' where sender='admin' and username='$_SESSION[login_user]' ;");

    ?>

    <div class="wrapper">
        <div style="height: 60px; width: 100%; background-color: #41a7fb; text-align: center; border-radius: 5px;">
            <h3 style="margin-top: -5px; padding-top: 10px; color: white;"><b>Admin</b></h3>
        </div>

        <div class="msg">
            <br>
            <?php
                while($row = mysqli_fetch_assoc($result)) {
                    if($row['sender'] == 'student') {
            ?>
            <!--_____________For Student______________________-->
            <br><div class="chat user">
                <div class="chatbox" style="color: white;">
                    <?php echo $row['message']; ?>
                </div>
                <div class="profile_img_container">
                    <?php
                    echo "<img class='img-circle profile_img' height=50 width=50 src='Images/".$_SESSION['pic']."'>";
                    ?>
                </div>
            </div>
            <?php
                    } 
                    else
                     {
            ?>
            <!--_________________For Admin_______________________-->
            <div class="chat admin">
                <div class="profile_img_container1">
                    <img style="height: 50px; width: 50px; border-radius: 50%;" src="Images/Image 8.jpeg">
                </div>
                <div class="chatbox1" style="color: white;">
                    <?php echo $row['message']; ?>
                </div>
            </div>
            <?php
                     }
                }
            ?>
        </div>

        <div style="height: 100px; padding-top: 10px;">
            <form action="" method="post">
                <input type="text" name="message" class="form-control" required="" placeholder="Write your message..." style="float: left;"> &nbsp
                <button class="btn btn-info btn-lg" type="submit" name="submit"><span class="glyphicon glyphicon-send"></span>&nbsp Send</button>
            </form>
        </div>
    </div>
</body>
</html>