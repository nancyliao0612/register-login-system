<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>MIS 233｜Lab2</title>
    <!-- CSS Style -->
    <link rel="stylesheet" type="text/css" href="./style.css" />
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <?php
      if(isset($_POST["submit"])){
        $uname = $_POST["uname"];
        $upass = $_POST["upassword"];

        $db = new mysqli("localhost", "root", "", "mis233");
        $result = $db -> query("SELECT * FROM users where uname = '$uname' and upassword = '$upass'");

        // echo $result -> num_rows;
        if($result -> num_rows == 0){
          echo "enter your username and uesrpassword again";
        }else{
          $_SESSION["check"] = $upass;
          header("Location:userindex.php");
        }
      }
    ?>
    <div id="top">
      <h1>MIS 233.01</h1>
      <p>Web Based Application Programming</p>
    </div>
    <div class="wrapper">
      <!-- include -->
      <?php
        include "menu.php";
        ?>
      <div id="img-style">
        <img src="./img/hiking.JPG" alt="hiking" width="155px" />
      </div>

      <div id="main">
        <h1>Login Form</h1>
        <form action="login.php" method="post">
          <label for="uname">User Name</label>
          <input type="text" id="uname" name="uname">
          <label for="upassword">User Password</label>
          <input type="password" id="upassword" name="upassword">
          <input type="submit" name="submit" value="SEND">
        </form>  
      </div>
      <div id="ann">
        <h3>Announcements</h3>
        <p><a href="login.php" target="_blank">Login</a></p>
        <p><a href="registration.php" target="_blank">Registration</a></p>
      </div>
    </div>
    <div id="bottom">
      <table id="category">
        <tr>
          <td class="cellitem">
            &nbsp;&nbsp;&nbsp;&nbsp; Company&nbsp;&nbsp;&nbsp;&nbsp;
          </td>
          <td class="cellitem">&nbsp;&nbsp;About&nbsp;&nbsp;</td>
          <td class="cellitem">&nbsp;&nbsp;Mission&nbsp;&nbsp;</td>
          <td class="cellitem">&nbsp;&nbsp;Comment&nbsp;&nbsp;</td>
        </tr>
      </table>
      <p>MIS 233.01 - Web Based Application Programming</p>
    </div>
  </body>
</html>
