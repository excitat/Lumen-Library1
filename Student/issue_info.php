<?php
    include "connection.php";
    include "navbar5.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Issue Information</title>
    <style type="text/css">
        .search {
            padding-left: 800px;
            margin-top: 100px;
        }
        .form-control {
            background-color: white;
            width: 300px;
            height: 35px;
            color: black;
        }
        body {
            background-image: url(Images/info2.jpeg);
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
            height: 700px;
            width: 900px;
            background-color: white;
            opacity: .8;
            color: black;
            border-radius: 20px;
        }
        .scroll {
            width: 100%;
            height: 400px;
            overflow: auto;
        }
    </style>
</head>
<body>
    <!--______________________Side Navigation__________________-->
    <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div style="color: deepskyblue; font-size: 20px; margin-left: 80px; font-size: 20px;">
            <?php
                if(isset($_SESSION['login_user'])) {
                    echo "<img class='img-circle profile_img' height=120 width=120 src='Images/".$_SESSION['pic']."'>";
                    echo "</br></br>";
                    echo "Welcome ".$_SESSION['login_user'];
                    echo "</br>";
                }
            ?>
        </div><br><br>
        <div class="h"><a href="books.php">Books</a></div><br>
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
        <br>
        <div class="container">
            <br>
            <h3 style="text-align: center;">Information of Borrowed Books</h3>
            <?php
                $c = 0;
                if(isset($_SESSION['login_user'])) {
                    $username = $_SESSION['login_user'];
                    $sql = "SELECT student.username, matricule, books.bid, name, authors, edition, issue_date,return_date, return_date_time 
                            FROM student 
                            INNER JOIN issue_book ON student.username = issue_book.username 
                            INNER JOIN books ON issue_book.bid = books.bid 
                            WHERE issue_book.approve = 'Yes' AND student.username = '$username' ORDER BY return_date DESC";

                    $res = mysqli_query($db, $sql);

                    echo "<div class='scroll'>";
                    echo "</br></br>";
                    echo "<table class='table table-bordered' style='width: 100%;'>";
                    echo "<tr style='background-color: deepskyblue; color: black;'>";
                    echo "<th>Student Username</th>";
                    echo "<th>Matricule</th>";
                    echo "<th>Book ID</th>";
                    echo "<th>Book Name</th>";
                    echo "<th>Authors</th>";
                    echo "<th>Edition</th>";
                    echo "<th>Issue Date</th>";
                    echo "<th>Return Date</th>";
                    echo "</tr>";

                    while ($row = mysqli_fetch_assoc($res)) {
                        $d = date("Y-m-d H:i:s");
                        if($d > $row['return_date_time']) {
                            $c = $c + 1;
                            $var = '<p style="color:yellow; background-color:red;">EXPIRED</p>';
                            mysqli_query($db, "UPDATE issue_book SET approve='$var' WHERE return_date_time='$row[return_date_time]' AND approve='Yes' LIMIT $c;");
                        }
                        
                        echo "<tr>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['matricule'] . "</td>";
                        echo "<td>" . $row['bid'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['authors'] . "</td>";
                        echo "<td>" . $row['edition'] . "</td>";
                        echo "<td>" . $row['issue_date'] . "</td>";
                        echo "<td>" . $row['return_date'] . "</td>";
                        echo "</tr>";
                    }
                    
                    echo "</table>";
                    echo "</div>";
                } else {
                    echo "<h3 style='text-align: center;'>Login to see information of Borrowed Books</h3>";
                }
            ?>
        </div>
    </div>
</body>
</html>