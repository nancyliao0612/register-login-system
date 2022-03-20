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
        $newPassword = $_POST["newPassword"];
        $newPassword2 = $_POST["newPassword2"];

        $db = new mysqli("us-cdbr-east-05.cleardb.net", "ba8a20c077011f", "a2f82246", "heroku_348200725298d23");

        $result = $db -> query("UPDATE users SET userPassword = '$newPassword' and userPassword2 = '$newPassword2' WHERE userEmail = '$userEmail'");

        if($result && strlen($userEmail) !== 0 && strlen($newPassword) >= 6) {
          echo "<div class='warning-message'>Your user password with the email<span class='highlight'>&nbsp;$userEmail&nbsp;</span>is reseted. You may <a href='index.php' class='highlight'>&nbsp;login&nbsp;</a> right now</div>";
        }else {
          echo "<p class='warning-message'>something is wrong. Please try again</p>";
        }

      }
    ?>
    <main class="card-wrapper">
      <div class="card-container">
        <?php
        echo "<h2>Reset Password</h2>";
        ?>
        <div class="warning-texts">
          <?php
          if(isset($_POST["submit"])){
            if(strlen($userEmail) === 0){
              echo "<li>Email can't be blank</li>";
            }
            if(strlen($newPassword) === 0 || strlen($newPassword2) === 0){
              echo "<li>Password can't be blank</li></ul>";
            }
          }
          ?>
        </div>
        <form action="resetPassword.php" method="post" autocomplete>
          <div class="input-container full-width-input">
            <label for="">Email</label>
            <input type="email" required name="email"/>
          </div>
          <div class="input-container full-width-input">
            <label class="label-inline" for=""><p>New Password&nbsp;&nbsp;</p>
            <?php
            if(isset($_POST["submit"])){
              if($newPassword !== $newPassword2){
                echo "<span>*Passwords don't match</span>";
              } else if($newPassword === $newPassword2 && strlen($newPassword) <= 6 && strlen($newPassword) > 0){
                echo "<span>*Password is too short</span>";
              }
            }
            ?>
            </label>            <input type="password" name="newPassword" placeholder="6+ characters" />
          </div>
          <div class="input-container full-width-input">
            <label for="">Confirm New Password</label>
            <input type="password" name="newPassword2" placeholder="6+ characters" />
          </div>
          <button type="submit" name="submit">Sign in</button>
        </form>
      </div>
    </main>
  </body>
</html>
