<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Page</title>
    <!-- CSS Style -->
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
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
        $userEmail = $_POST["email"];
        $password = $_POST["upassword"];

        $db = new mysqli("us-cdbr-east-05.cleardb.net", "ba8a20c077011f", "a2f82246", "heroku_348200725298d23");

        $result = $db -> query("SELECT * FROM users where userEmail = '$userEmail' and userPassword = '$password'");

        $row = $result -> fetch_row();
        $userName = $row[1]; 
        $_SESSION["userName"] = $userName;

        // echo $result -> num_rows;
        if($result -> num_rows == 0){
          echo "<div class='warning-message'><h3>We couldn’t find an account matching the email and password you entered. Please check your email and password and try again.</h3></div>";
        }else{
          $_SESSION["check"] = $userEmail;
          header("Location: userindex.php");
        }

      }
    ?>
    <main class="card-wrapper">
      <div class="card-container">
        <?php
        echo "<h2>Sign in</h2>";
        ?>
        <form action="sign-in.php" method="post" autocomplete>
          <div class="input-container full-width-input">
            <label for="">Email</label>
            <input type="email" required name="email"/>
          </div>
          <div class="input-container full-width-input">
            <label for="">Password &nbsp;<a href="resetPassword.php"> (forgot password?)</a></label>
            <input type="password" name="upassword" placeholder="6+ characters" />
          </div>
          <button type="submit" name="submit">Sign in</button>
        </form>
      </div>
    </main>
  </body>
</html>
