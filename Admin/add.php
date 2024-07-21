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
          background-color: #d3ebef;
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
.book
{
  width: 400px;
  margin: 0px auto;
}
.form-control
{
  color: black;
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
                    echo "</br>";

                    echo "Welcome ".$_SESSION['login_user'];
                    echo "</br>";
                }
                    
                ?>
        </div><br><br>

 <div class="h"> <a href="add.php">Add Books</a> </div><br>
 <div class="h"> <a href="request.php">Book Request</a> </div><br>
  <div class="h"> <a href="issue_info.php">Issue Information</a> </div><br>
  <div class="h"><a href="expired.php">Expired List</a></div><br>
</div>

<div id="main">
  
  <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; Menu</span>
  <div class="container" style="text-align: center;">

    <h2 style="color: black; font-family: Lucida Console; text-align: center;"><b>Add New Books</b></h2>

    <form class="book" action="" method="post">

      <input type="text" name="bid" class="form-control" placeholder="Book id" required=""><br>
      <input type="text" name="name" class="form-control" placeholder="Book Name" required=""><br>
      <input type="text" name="authors" class="form-control" placeholder="Author(s) Name" required=""><br>
      <input type="text" name="edition" class="form-control" placeholder="Edition" required=""><br>
      <input type="text" name="status" class="form-control" placeholder="Status" required=""><br>
      <input type="text" name="quantity" class="form-control" placeholder="Quantity" required=""><br>
      <input type="text" name="department" class="form-control" placeholder="Department" required=""><br>

      <button style="border-radius: 10px;" class="btn btn-default" type="submit" name="submit">ADD</button>
      
    </form>
  </div>
<?php
  if(isset($_POST['submit']))
  {
    if(isset($_SESSION['login_user']))
    {
        mysqli_query($db,"INSERT INTO books VALUES ('$_POST[bid]', '$_POST[name]', '$_POST[authors]', '$_POST[edition]', '$_POST[status]', '$_POST[quantity]', '$_POST[department]'), '0' ;");
      ?>
      <script type="text/javascript">
        alert("Book Added Successfully.");
        window.location="books.php";
      </script>
      <?php

    }
    else
    {
      ?>
        <script type="text/javascript">
          alert("You need to login first.");
        </script>
      <?php 
    }
  }
?>

</div>

<script>
function openNav() {
  document.getElementById("mySidenav").style.width = "300px";
  document.getElementById("main").style.marginLeft = "300px";
  document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.body.style.backgroundColor = "#d3ebef";
}
</script>
</body>
</html>