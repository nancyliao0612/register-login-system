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
        $ufullname = $_POST["ufullname"];
        $upass = $_POST["upass"];
        $upass2 = $_POST["upass2"];

        if($upass != $upass2){
          echo "passwords don't match";
        }
        else{
        $db = new mysqli("localhost", "root", "", "mis233");
        $result = $db -> query("INSERT INTO users(uname, ufullname, upassword) VALUES('$uname', '$ufullname', '$upass')");

        echo "Hello $ufullname, you successfully created your account!";
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
        <h1>Registration Form</h1>
        <form action="registration.php" method="post">
          <label for="uname">User Name</label>
          <input type="text" id="uname" name="uname">
          <label for="ufullname">User Full Name</label>
          <input type="text" id="ufullname" name="ufullname">
          <label for="upass">User Password</label>
          <input type="password" id="upass" name="upass">
          <label for="upass2">User Password(again)</label>
          <input type="password" id="upass2" name="upass2">
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
