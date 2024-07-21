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
        .search
        {
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
</style>
</head>
<body>
    <?php
        $b=mysqli_query($db,"SELECT * FROM books ORDER BY book_count DESC limit 0,3 ;");
    ?>
    <div style="width: 100%; height: 50px; margin-top: -20px;">
        <div style="background-color: #F44336; padding: 10px; width: 10%; height: 50px; float: left;">
            <h3 style="color: white; margin-top: 0px;">Trending: </h3>
            
        </div>
        <div style="background-color: #ffcccc; width: 90%; height: 50px; float: left; padding: 10px;">
            <table>
                <?php
                while($b2=mysqli_fetch_assoc($b))
                {
                    echo "<tr style='color: black; width: 400px; margin-top: 0px; float: left;'>";
                    echo "<td>"; echo "[".$b2['bid']."]&nbsp&nbsp"; echo "</td>";
                    echo "<td>"; echo $b2['name']; echo "</td>";
                    echo "</tr>";
                }
                ?>
                    
                </tr>
            </table>
            
        </div>
        
    </div>
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


  <div class="h"><a href="books.php">Books</a></div><br>
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
    </div>

    <!--____________________Request a Book_______________-->

    <div class="search">
        <form class="navbar-form" method="post" name="form1">

                <input class="form-control" type="text" name="bid" placeholder="Enter Book ID..." required="">
                <button style="background-color: #3abfdd;" type="submit" name="submit3" class="btn btn-default">Request
                </button>
            
        </form>
    </div>



    <h2 style="padding-left: 8px;">List Of Books</h2>
<?php

    if(isset($_POST['submit']))
    {
            $q=mysqli_query($db,"SELECT * FROM books WHERE name like '%$_POST[search]%' ");
            if(mysqli_num_rows($q)==0)
            {
                echo "Sorry! No book find. Try searching again.";
            }
            else
            {
                echo "<table class='table table-bordered table-hover'>";
                echo "<tr style='background-color: #3abfdd;'>";
                // Table header
                echo "<th>"; echo "ID"; echo "</th>";
                echo "<th>"; echo "Book Name"; echo "</th>";
                echo "<th>"; echo "Authors Name"; echo "</th>";
                echo "<th>"; echo "Edition"; echo "</th>";
                echo "<th>"; echo "Status"; echo "</th>";
                echo "<th>"; echo "Quantity"; echo "</th>";
                echo "<th>"; echo "Department"; echo "</th>";
                echo "</tr>";

                while ($row = mysqli_fetch_assoc($q)) {
                    echo "<tr>";
                    echo "<td>"; echo $row['bid']; echo "</td>";
                    echo "<td>"; echo $row['name']; echo "</td>";
                    echo "<td>"; echo $row['authors']; echo "</td>";
                    echo "<td>"; echo $row['edition']; echo "</td>";
                    echo "<td>"; echo $row['status']; echo "</td>";
                echo "<td>"; echo $row['quantity']; echo "</td>";
                    echo "<td>"; echo $row['department']; echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
        }
            /* If Button is not pressed */
        else
        {
            $res=mysqli_query($db,"SELECT * FROM books ORDER BY name ASC;");
            if ($res)
            {
                echo "<table class='table table-bordered table-hover'>";
                echo "<tr style='background-color: #3abfdd;'>";
                // Table header
                echo "<th>"; echo "ID"; echo "</th>";
                echo "<th>"; echo "Book Name"; echo "</th>";
                echo "<th>"; echo "Authors Name"; echo "</th>";
                echo "<th>"; echo "Edition"; echo "</th>";
                echo "<th>"; echo "Status"; echo "</th>";
                echo "<th>"; echo "Quantity"; echo "</th>";
                echo "<th>"; echo "Department"; echo "</th>";
                echo "</tr>";

                while ($row = mysqli_fetch_assoc($res)) {
                    echo "<tr>";
                    echo "<td>"; echo $row['bid']; echo "</td>";
                    echo "<td>"; echo $row['name']; echo "</td>";
                    echo "<td>"; echo $row['authors']; echo "</td>";
                    echo "<td>"; echo $row['edition']; echo "</td>";
                    echo "<td>"; echo $row['status']; echo "</td>";
                    echo "<td>"; echo $row['quantity']; echo "</td>";
                    echo "<td>"; echo $row['department']; echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            }

        }

        if(isset($_POST['submit3']))
        {
            if(isset($_SESSION['login_user']))
            {
                $sql2=mysqli_query($db,"SELECT * FROM books WHERE bid='$_POST[bid]' ;");
                $row1=mysqli_fetch_assoc($sql2);
                $count1=mysqli_num_rows($sql2);
                if($count1!=0) /* Meaning that the book id is in the book table*/
                {

                    mysqli_query($db,"INSERT INTO issue_book VALUES('$_SESSION[login_user]', '$_POST[bid]', '', '', '');");

                    ?>
                        <script type="text/javascript">
                            alert("Wait for Approval");
                            window.location="request.php"
                        </script>

                    <?php
                }
                else
                {
                    ?>
                    <script type="text/javascript">
                        alert("The book is not available in the library.");
                    </script>
                    <?php
                }
            }
            else
            {
                ?>
                    <script type="text/javascript">
                        alert("You must login to request a book");
                    </script>

                <?php
            }
        } 
?>
    </div>
</body>
</html>