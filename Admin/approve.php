<?php
    include "connection.php";
    include "navbar4.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Approve Request</title>
    <style type="text/css">
        .search {
            padding-left: 800px;
            margin-top: 100px;
        }
        .form-control {
            width: 300px;
            height: 35px;
            color: black;
        }
        body {
            background-image: url(Images/request2.jpeg);
            background-repeat: no-repeat;
            background-size: cover;
            font-family: "Lato", sans-serif;
            transition: background-color .5s;
        }
        .sidenav {
            height: 100%;
            margin-top: 74px;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #222;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }
        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }
        .sidenav a:hover {
            color: #f1f1f1;
        }
        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }
        #main {
            transition: margin-left .5s;
            padding: 16px;
        }
        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }
        .img-circle {
            margin-left: 14px;
        }
        .h:hover {
            color: white;
            width: 250px;
            height: 50px;
            background-color: deepskyblue;
        }
        .container {
            height: 600px;
            background-color: black;
            opacity: .8;
            color: white;
            border-radius: 20px;
        }
        .btn:hover {
            background-color: springgreen;
        }
        .Approve {
            margin-left: 430px; 
        }
    </style>
</head>
<body>
    <!--______________________Side Navigation__________________-->

    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div style="color: deepskyblue; font-size: 20px; margin-left: 80px; font-size: 20px;">
            <?php
            if(isset($_SESSION['login_user']))
            {
                echo "<img class='img-circle profile_img' height=120 width=120 src='Images/".$_SESSION['pic']."'>";
                echo "</br></br>";
                echo "Welcome ".$_SESSION['login_user'];
                echo "</br>";
            }
            ?>
        </div><br><br>

        <div class="h"><a href="add.php">Add Books</a></div><br>
        <div class="h"><a href="request.php">Book Request</a></div><br>
        <div class="h"><a href="issue_info.php">Issue Information</a></div><br>
        <div class="h"><a href="expired.php">Expired List</a></div><br>
    </div>

    <div id="main">
        <span style="font-size:30px; color: white; cursor:pointer" onclick="openNav()">&#9776; Menu</span>
        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "300px";
                document.getElementById("main").style.marginLeft = "300px";
                document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
            }
            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("main").style.marginLeft= "0";
                document.body.style.backgroundColor = "white";
            }
        </script>
        <div class="container">
            <br><h2 style="text-align: center;">Approve Request</h2><br><br><br>

            <form class="Approve" action="" method="post">
                <input class="form-control" type="text" name="approve" placeholder="Approve or not" required=""><br>
                <input class="form-control" type="text" name="issue_date" placeholder="Issue Date yyyy-mm-dd" required=""><br>
                <input class="form-control" type="text" name="return_date" placeholder="Return Date yyyy-mm-dd" required=""><br>

                <input type="text" name="tm" class="form-control" placeholder="Return Date Jul 06, 2025 23:10:00" required=""><br>
                <button style="border-radius: 15px;" class="btn btn-default" type="submit" name="submit">Approve</button>
            </form>
        </div>
    </div>

    <?php
        if(isset($_POST['submit'])) {
            mysqli_query($db,"INSERT into timer VALUES ('$_SESSION[student_name]', '$_SESSION[bid]', '$_POST[tm]') ;");
            $approve = $_POST['approve'];
            $issue_date = $_POST['issue_date'];
            $return_date1=$_POST['return_date'];
            $return_date = $_POST['tm'];
            $username = $_SESSION['student_name'];
            $bid = $_SESSION['bid'];


            // Check if the request has already been approved
            $check_approval = mysqli_query($db, "SELECT approve FROM issue_book WHERE username='$username' AND bid='$bid'");
            $row = mysqli_fetch_assoc($check_approval);

            if ($row['approve'] == 'Yes') {
                echo "<script type='text/javascript'>
                        alert('This request has already been approved.');
                        window.location='request.php';
                      </script>";
            } else {
                mysqli_query($db,"UPDATE issue_book SET approve='$approve', issue_date='$issue_date', return_date='$return_date1', return_date_time='$return_date' WHERE username='$username' AND bid='$bid'");
                mysqli_query($db,"UPDATE books SET quantity = quantity-1 WHERE bid='$bid'");
                mysqli_query($db,"UPDATE books SET book_count= book_count+1 where bid='$_SESSION[bid]' ;");
                
                $res = mysqli_query($db,"SELECT quantity FROM books WHERE bid='$bid'");
                while($row = mysqli_fetch_assoc($res)) {
                    if($row['quantity'] == 0) {
                        mysqli_query($db,"UPDATE books SET status='not-available' WHERE bid='$bid'");
                    }
                }
                echo "<script type='text/javascript'>
                        alert('Updated Successfully');
                        window.location='request.php';
                      </script>";
            }
        }
    ?>
</body>
</html>