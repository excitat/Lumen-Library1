<?php
    include "connection.php";
    include "navbar4.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Issue Information</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        .search
        {
            padding-left: 700px;
            margin-top: 60px;
        }
        .form-control
        {
            background-color: white;
            width: 230px;
            height: 35px;
            color: black;
        }
        body 
        {
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
  padding-left: 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
.img-circle
{
    margin-left: 14px;
}
.h:hover
{
    color: white;
    width: 250px;
    height: 50px;
    background-color: deepskyblue;
}
.container
{
    height: 800px;
    width: 1000px;
    background-color: white;
    opacity: .8;
    color: black;
    border-radius: 30px;
    margin-top: -60px;
}
.scroll
{
    width: 100%;
    height: 400px;
    overflow: auto;
}
.btn:hover
{
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
<br>
<div class="container">
    <div style="float: left; padding: 30px;">
        <form method="post" action="">
            <button name="submit2" class="btn btn-default" style="background-color: green; color: yellow;">RETURNED</button> &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp
            <button name="submit3" class="btn btn-default" style="background-color: red; color: yellow;">EXPIRED</button>
        </form>
    </div>
    
    <?php
        if(isset($_SESSION['login_user']))
        {
            ?>
            <div class="search">
                <form method="post" action="" name="form2">
                    <input type="text" name="username" class="form-control" placeholder="Student username" required=""><br>
                    <input type="text" name="bid" class="form-control" placeholder="Book ID" required=""><br>
            <button style="border-radius: 15px;" class="btn btn-default" name="submit" type="submit">Submit</button>
            
        </form>
        
    </div>
    <?php

    if(isset($_POST['submit']))
    {
        $res=mysqli_query($db,"SELECT * FROM issue_book WHERE username='$_POST[username]' and bid= '$_POST[bid]' ;");

        $day = 0;
        $fine = 0;

        while($row=mysqli_fetch_assoc($res))
        {
            $d= strtotime($row['return_date']);
            $c= strtotime(date("Y-m-d"));
            $diff= $c-$d;

            if($diff>=0)
            {
                $day= floor($diff/(60*60*24));
                $fine= $day*100; 
            }
        }

        $x=date("Y-m-d");
        mysqli_query($db,"INSERT INTO fines VALUES ('$_POST[username]', '$_POST[bid]', '$x', '$day', '$fine', 'not paid') ;");

        $var1='<p style="color:yellow; background-color:green;">RETURNED</p>';
        mysqli_query($db,"UPDATE issue_book SET approve='$var1' where username='$_POST[username]' and bid='$_POST[bid]' ");
        mysqli_query($db,"UPDATE books SET quantity = quantity+1 where bid='$_POST[bid]' ");
    }

        }
    ?>
    <br>
    <!--<h3 style="text-align: center;">Expired List</h3>--><br>
    <?php

    $c=0;
        if(isset($_SESSION['login_user']))
        {
            $return='<p style="color:yellow; background-color:green;">RETURNED</p>';
            $expire='<p style="color:yellow; background-color:red;">EXPIRED</p>';
            
            if(isset($_POST['submit2']))
            {
                $sql = "SELECT student.username, matricule, books.bid, name, authors, edition, approve, issue_date, return_date 
                FROM student 
                INNER JOIN issue_book ON student.username = issue_book.username 
                INNER JOIN books ON issue_book.bid = books.bid 
                WHERE issue_book.approve = '$return'  ORDER BY return_date DESC";
                $res=mysqli_query($db,$sql);
            }
            elseif (isset($_POST['submit3'])) 
            {
                $sql = "SELECT student.username, matricule, books.bid, name, authors, edition, approve, issue_date, return_date 
                FROM student 
                INNER JOIN issue_book ON student.username = issue_book.username 
                INNER JOIN books ON issue_book.bid = books.bid 
                WHERE issue_book.approve = '$expire' ORDER BY return_date DESC";
                $res=mysqli_query($db,$sql);
            }
            else
            {
                $sql = "SELECT student.username, matricule, books.bid, name, authors, edition, approve, issue_date, return_date 
                FROM student 
                INNER JOIN issue_book ON student.username = issue_book.username 
                INNER JOIN books ON issue_book.bid = books.bid 
                WHERE issue_book.approve != '' and issue_book.approve != 'Yes' ORDER BY return_date DESC";
                $res=mysqli_query($db,$sql);
            }


            echo "<div class='scroll'>";
            echo "</br></br>";
            echo "<table class='table table-bordered' style='width: 100%;'>";
            //Table header
                
                echo "<tr style='background-color: deepskyblue; color: black;'>";
                echo "<th>Student Username</th>";
                echo "<th>Matricule</th>";
                echo "<th>Book ID</th>";
                echo "<th>Book Name</th>";
                echo "<th>Authors</th>";
                echo "<th>Edition</th>";
                echo "<th>Approve Status</th>";
                echo "<th>Issue Date</th>";
                echo "<th>Return Date</th>";
                echo "</tr>";

                

                while ($row = mysqli_fetch_assoc($res)) 
                {
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['matricule'] . "</td>";
                    echo "<td>" . $row['bid'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['authors'] . "</td>";
                    echo "<td>" . $row['edition'] . "</td>";
                    echo "<td>" . $row['approve'] . "</td>";
                    echo "<td>" . $row['issue_date'] . "</td>";
                    echo "<td>" . $row['return_date'] . "</td>";
                    echo "</tr>";
                }
                
                    echo "</table>";
                    echo "</div>";
        }
        else
        {
            ?>
                <h3 style="text-align: center;">Login to see information of Borrowed Books</h3>
            <?php
        }

    ?>

</div>
</div>
</body>
</html>
