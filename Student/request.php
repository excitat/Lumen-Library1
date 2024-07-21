<?php
    include "connection.php";
    include "navbar5.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Request</title>
    <style type="text/css">
        .search {
            padding-left: 1000px;
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
            .sidenav { padding-top: 15px; }
            .sidenav a { font-size: 18px; }
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
        th, td, input {
            width: 100px;
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

        <br><br>
        <div class="container">
        <?php
            if(isset($_SESSION['login_user'])) {
                $q = mysqli_query($db, "SELECT * FROM issue_book WHERE username='$_SESSION[login_user]' AND approve= '';");
                if (!$q) {
                    echo "Error: " . mysqli_error($db);
                } elseif(mysqli_num_rows($q) == 0) {
                    echo "<h2><b>There is no pending request</b></h2>";
                } else {
                    ?>
                    <form method="post">
                        <?php
                        echo "<table class='table table-bordered table-hover'>";
                        echo "<tr style='background-color: #3abfdd;'>";
                        // Table header
                        echo "<th>Select</th>";
                        echo "<th>Book ID</th>";
                        echo "<th>Approve Status</th>";
                        echo "<th>Issue Date</th>";
                        echo "<th>Return Date</th>";
                        echo "</tr>";
                        while ($row = mysqli_fetch_assoc($q)) {
                            echo "<tr style='background-color: whitesmoke;'>";
                            ?>
                            <td><input type="checkbox" name="check[]" value="<?php echo $row["bid"] ?>"></td>
                            <?php
                            echo "<td>".$row['bid']."</td>";
                            echo "<td>".$row['approve']."</td>";
                            echo "<td>".$row['issue_date']."</td>";
                            echo "<td>".$row['return_date']."</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                        ?>
                        <p align="center"><button type="submit" name="delete" class="btn btn-success">Delete</button></p>
                    </form>
                    <?php
                }
            }
        ?>
        </div>
        <?php
        if(isset($_POST['delete'])) {
            if(isset($_POST['check'])) {
                foreach ($_POST['check'] as $delete_id) {
                    mysqli_query($db, "DELETE FROM issue_book WHERE bid='$delete_id' AND username='$_SESSION[login_user]';");
                }
            }
        }
        ?>
    </div>
</body>
</html>
