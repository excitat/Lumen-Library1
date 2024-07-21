<?php
    include "connection.php";
    include "navbar4.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Books</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        .search {
            padding-left: 1000px;
        }
        body {
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
            .sidenav {
                padding-top: 15px;
            }
            .sidenav a {
                font-size: 18px;
            }
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
                    echo "</br>";
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
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
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

        <!--_______________________ Search Bar ______________________-->
        <div class="search">
            <form class="navbar-form" method="post" name="form1">
                <input class="form-control" type="text" name="search" placeholder="search book..." required="">
                <button style="background-color: #3abfdd;" type="submit" name="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </form>

            <form class="navbar-form" method="post" name="form1">
                <input class="form-control" type="text" name="bid" placeholder="Enter Book ID..." required="">
                <button style="background-color: #3abfdd;" type="submit" name="submit2" class="btn btn-default">Delete</button>
            </form>
        </div>

        <h2 style="padding-left: 8px;">List Of Books</h2>
        <?php
            if(isset($_POST['submit'])) {
                $q = mysqli_query($db, "SELECT * FROM books WHERE name LIKE '%$_POST[search]%' ");
                if(mysqli_num_rows($q) == 0) {
                    echo "Sorry! No book found. Try searching again.";
                } else {
                    echo "<table class='table table-bordered table-hover'>";
                    echo "<tr style='background-color: #3abfdd;'>";
                    echo "<th>ID</th>";
                    echo "<th>Book Name</th>";
                    echo "<th>Authors Name</th>";
                    echo "<th>Edition</th>";
                    echo "<th>Status</th>";
                    echo "<th>Quantity</th>";
                    echo "<th>Department</th>";
                    echo "</tr>";

                    while ($row = mysqli_fetch_assoc($q)) {
                        $quantity = $row['quantity'];
                        $status = '';
                        if ($quantity > 5) {
                            $status = 'Available';
                        } elseif ($quantity > 0 && $quantity <= 5) {
                            $status = 'Limited';
                        } else {
                            $status = 'Not Available';
                        }

                        // Update the status in the database
                        mysqli_query($db, "UPDATE books SET status='$status' WHERE bid=".$row['bid']);

                        echo "<tr>";
                        echo "<td>" . $row['bid'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['authors'] . "</td>";
                        echo "<td>" . $row['edition'] . "</td>";
                        echo "<td>" . $status . "</td>";
                        echo "<td>" . $row['quantity'] . "</td>";
                        echo "<td>" . $row['department'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            } else {
                $res = mysqli_query($db, "SELECT * FROM books ORDER BY name ASC;");
                if ($res) {
                    echo "<table class='table table-bordered table-hover'>";
                    echo "<tr style='background-color: #3abfdd;'>";
                    echo "<th>ID</th>";
                    echo "<th>Book Name</th>";
                    echo "<th>Authors Name</th>";
                    echo "<th>Edition</th>";
                    echo "<th>Status</th>";
                    echo "<th>Quantity</th>";
                    echo "<th>Department</th>";
                    echo "</tr>";

                    while ($row = mysqli_fetch_assoc($res)) {
                        $quantity = $row['quantity'];
                        $status = '';
                        if ($quantity > 5) {
                            $status = 'Available';
                        } elseif ($quantity > 0 && $quantity <= 5) {
                            $status = 'Limited';
                        } else {
                            $status = 'Not Available';
                        }

                        // Update the status in the database
                        mysqli_query($db, "UPDATE books SET status='$status' WHERE bid=".$row['bid']);

                        echo "<tr>";
                        echo "<td>" . $row['bid'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['authors'] . "</td>";
                        echo "<td>" . $row['edition'] . "</td>";
                        echo "<td>" . $status . "</td>";
                        echo "<td>" . $row['quantity'] . "</td>";
                        echo "<td>" . $row['department'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            }

            if(isset($_POST['submit2'])) {
                if(isset($_SESSION['login_user'])) {
                    mysqli_query($db, "DELETE from books where bid='$_POST[bid]';");
                    ?>
                    <script type="text/javascript">
                        alert("Book deleted Successfully");
                        window.location="books.php"
                    </script>
                    <?php
                } else {
                    ?>
                    <script type="text/javascript">
                        alert("Please Login first");
                    </script>
                    <?php
                }
            }
        ?>
    </div>
</body>
</html>
