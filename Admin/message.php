<?php
    include "connection.php";
    include "navbar4.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Messages</title>
<style type="text/css">
    body
    {
        background-image: url(Images/message2.jpeg);
        background-repeat: no-repeat;
        background-size: cover;
        height: 595px;
    }
    .left_box
    {
        height: 650px;
        width: 500px;
        float: left;
        background-color: #d0d8db;
        margin-top: -20px;
    }
    .left_box2
    {
        height: 650px;
        width: 400px;
        background-color: #65a2c9;
        border-radius: 20px;
        float: right;
        margin-right: 10px;

    }
    .left_box input
    {
        width: 150px;
        height: 30px;
        background-color: white;
        padding: 10px;
        margin: 10px;
        border-radius: 10px;
    }
    .list
    {
        height: 520px;
        width: 400px;
        background-color: #65a2c9;
        float: right;
        color: white;
        padding: 10px;
        overflow-y: scroll;
        overflow-x: hidden;
    }
    .right_box
    {
        height: 650px;
        width: 900px;
        margin-left: 443px;
        background-color: #d0d8db;
        margin-top: -20px;
        padding: 10px;
    }
    .right_box2
    {
        height: 650px;
        width: 620px;
        margin-top: -20px;
        padding: 20px;
        border-radius: 20px;
        background-color: #65a2c9;
        margin-left: 60px;
    }
    tr:hover
    {
        background-color: white;
        cursor: pointer;
        opacity: .9;
        color: black;
    }
    .form-control {
            height: 46px;
            width: 80%;
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
            width: 456px;
            padding: 13px 10px;
            background-color: #c552db;
            border-radius: 10px;
            order: 1; /* Ensure the chatbox is first in order */
            margin-left: 10px;
        }
        .profile_img_container {
            order: 0; /* Ensure the profile image is second in order */
            margin-left: 10px; /* Add some spacing between the chatbox and the profile image */
        }
        .profile_img {
            border-radius: 50%;
        }
        .admin .chatbox1 {
            height: 50px;
            width: 490px;
            padding: 13px 10px;
            background-color: #231d21;
            border-radius: 10px;
            order: 0; /* Ensure the chatbox is second in order */
            margin-left: 10px; /* Add some spacing between the profile image and the chatbox */
        }
        .profile_img_container1 {
            order: 1; /* Ensure the profile image is first in order */
            margin-left: 0; /* Remove additional spacing */
            margin-right: 10px;
        }
</style>
</head>
<body>
<?php
    $sql1=mysqli_query($db,"SELECT student.pic, message.username FROM student INNER JOIN message ON student.username=message.username group by message.username ORDER BY message.status_read ;")
?>

<!--_______________________________Left Box________________________________-->

<div class="left_box">
    <div class="left_box2">
        <div>
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="username" id="uname">
                <button type="submit" name="submit" class="btn btn-default">SHOW</button>
                
            </form>
        </div>
        <div class="list">
            <?php
            if($sql1){
                echo "<table id='table' class='table'>";
                while ($res1=mysqli_fetch_assoc($sql1))
                {

                    echo "<tr>";
                        echo "<td width=65>"; echo "<img class='img-circle profile_img' height=60 width=60 src='Images/Image 8.jpeg'>"; echo "</td>";

                        echo "<td style='padding-top:25px;'>"; echo $res1['username']; echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";}
            ?>
        </div>
        
    </div>
        
</div>

<!--_______________________________Right Box_______________________________-->

<div class="right_box">
    <div class="right_box2">
    <br>
    <?php

/*--------------------------if submit is pressed-------------------------*/

        if(isset($_POST['submit']))
        {
            $res=mysqli_query($db,"SELECT * FROM message where username='$_POST[username]' ;");
            mysqli_query($db,"UPDATE message SET status_read='yes' where sender='student' and username='$_POST[username]' ;");

            if($_POST['username'] != '')
            {
                $_SESSION['username']=$_POST['username'];
            }

            ?>
            <div style="height: 70px; width: 100%; text-align: center; color: white;">
                <h3 style="margin-top: -5px;"> <?php echo $_SESSION['username']; ?> </h3>
            </div>
<!--______________________Show message__________________________-->

        <div class="msg">
                <br>

            <?php
                while($row = mysqli_fetch_assoc($res)) {
                    if($row['sender'] == 'student') {
            ?>

            <!--_____________For Student______________________-->
            <br><div class="chat user">
                <div class="chatbox" style="color: white;">
                    <?php echo $row['message']; ?>
                </div>
                <div class="profile_img_container">
                    <img style="height: 50px; width: 50px; border-radius: 50%;" src="Images/Image 8.jpeg">
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
                    &nbsp
                    <?php
                    echo "<img class='img-circle profile_img' style='margin-top: 5px;' height=50 width=50 src='Images/".$_SESSION['pic']."'>";
                    ?>
                    &nbsp&nbsp
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

            <div style="height: 30px; padding-top: 10px;">
            <form action="" method="post">
                <input type="text" name="message" class="form-control" required="" placeholder="Write your message..." style="float: left;"> &nbsp
                <button class="btn btn-info btn-lg" type="submit" name="submit1"><span class="glyphicon glyphicon-send"></span>&nbsp Send</button>
            </form>
            </div>

            <?php
        }
/*--------------------------if submit is not pressed-------------------------*/
        else
        {
            if($_SESSION['username']=='')
            {
                ?>
                    <img style="margin: 60px 80px; height: 280px; border-radius: 50%;" src="Images/tenor.gif" alt="animated">
                <?php
            }
            else
            {
                if(isset($_POST['submit1']))
                {
                    mysqli_query($db,"INSERT INTO message (username, message, status_read, sender) VALUES ('$_SESSION[username]', '$_POST[message]', 'no', 'admin');");

                    $res=mysqli_query($db,"SELECT * FROM message where username='$_SESSION[username]' ;");
                }
                else
                {
                    $res=mysqli_query($db,"SELECT * FROM message where username='$_SESSION[username]' ;");
                }
                ?>
                <div style="height: 70px; width: 100%; text-align: center; color: white;">
                    <h3 style="margin-top: -5px;"> <?php echo $_SESSION['username']; ?> </h3>
                </div>

        <div class="msg">
                <br>

            <?php
                while($row = mysqli_fetch_assoc($res)) {
                    if($row['sender'] == 'student') {
            ?>

            <!--_____________For Student______________________-->
            <br><div class="chat user">
                <div class="chatbox" style="color: white;">
                    <?php echo $row['message']; ?>
                </div>
                <div class="profile_img_container">
                    <img style="height: 50px; width: 50px; border-radius: 50%;" src="Images/Image 8.jpeg">
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
                    &nbsp
                    <?php
                    echo "<img class='img-circle profile_img' style='margin-top: 5px;' height=50 width=50 src='Images/".$_SESSION['pic']."'>";
                    ?>
                    &nbsp&nbsp
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
        <div style="height: 30px; padding-top: 10px;">
            <form action="" method="post">
                <input type="text" name="message" class="form-control" required="" placeholder="Write your message..." style="float: left;"> &nbsp
                <button class="btn btn-info btn-lg" type="submit" name="submit1"><span class="glyphicon glyphicon-send"></span>&nbsp Send</button>
            </form>
        </div>


            <?php
                
            }
        }

    ?>
        
    </div>
    
</div>

<script>
    var table = document.getElementById('table'),eIndex;
    for(var i=0; i< table.rows.length; i++)
    {
        table.rows[i].onclick =function()
        {
            rIndex = this.rowIndex
            document.getElementById("uname").value = this.cells[1].innerHTML;
        }
    }
</script>

</body>
</html>