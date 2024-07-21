<?php
    include "connection.php";
    include "navbar4.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book Request</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        .search
        {
            padding-left: 800px;
            margin-top: 70px;
        }
        .form-control
        {
            background-color: white;
            width: 300px;
            height: 35px;
            color: black;
        }
        body 
        {
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
    height: 700px;
    background-color: black;
    opacity: .8;
    color: white;
    border-radius: 20px;
}
.scroll
{
    width: 100%;
    height: 300px;
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
    <div class="search">
        <form method="post" action="" name="form2">
            <input type="text" name="username" class="form-control" placeholder="Student username" required=""><br>
            <input type="text" name="bid" class="form-control" placeholder="Book ID" required=""><br>
            <button class="btn btn-default" name="submit" type="submit">Submit</button>
            
        </form>
        
    </div>
    <h3 style="text-align: center;"><b>Request of Books</b></h3>
<?php
    if(isset($_SESSION['login_user']))
    {
        $sql = "SELECT student.username, matricule, books.bid, name, authors, edition, books.status 
                FROM student 
                INNER JOIN issue_book ON student.username = issue_book.username 
                INNER JOIN books ON issue_book.bid = books.bid 
                WHERE issue_book.approve = ''";

        $res = mysqli_query($db, $sql);

        if ($res) 
        {
            if(mysqli_num_rows($res) == 0) 
            {
                echo "<h2><b>There is no pending request</b></h2>";
            } else 
            {
                echo "<div class='scroll'>";
                echo "<table class='table table-bordered'>";
                echo "<tr style='background-color: white; color: black;'>";
                echo "<th>Student Username</th>";
                echo "<th>Matricule</th>";
                echo "<th>Book ID</th>";
                echo "<th>Book Name</th>";
                echo "<th>Authors</th>";
                echo "<th>Edition</th>";
                echo "</tr>";

                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<tr>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['matricule'] . "</td>";
                    echo "<td>" . $row['bid'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['authors'] . "</td>";
                    echo "<td>" . $row['edition'] . "</td>";

                    echo "</tr>";
                }
                echo "</table>";
                echo "</div>";
            }
        }
    }
    else 
    {
           ?>
           <br>
           <h4 style="text-align: center; color: yellow;"><b>You need to login to see the request.</b></h4>
            
           <?php
    }

    if(isset($_POST['submit']))
    {
        $_SESSION['student_name']=$_POST['username'];
        $_SESSION['bid']=$_POST['bid'];

        ?>
            <script type="text/javascript">
                window.location="approve.php";
            </script>

        <?php
    }

?>
</div>
</div>

</body>
</html>