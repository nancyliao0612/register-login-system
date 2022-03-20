<?php
  session_start();

  //Get Heroku ClearDB connection information
  $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
  $cleardb_server = $cleardb_url["host"];
  $cleardb_username = $cleardb_url["user"];
  $cleardb_password = $cleardb_url["pass"];
  $cleardb_db = substr($cleardb_url["path"],1);
  $active_group = 'default';
  $query_builder = TRUE;
  // Connect to DB
  $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign up</title>
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
        $fullName = $_POST["fullName"];
        $userName = $_POST["userName"];
        $email = $_POST["email"];
        $upassword = $_POST["upassword"];
        $upassword2 = $_POST["upassword2"];

        if($upassword === $upassword2 && strlen($upassword) >= 6){
          $db = new mysqli("us-cdbr-east-05.cleardb.net", "ba8a20c077011f", "a2f82246", "heroku_348200725298d23");
          $result = $db -> query("INSERT INTO users (fullName, userName, userEmail	,userPassword, userPassword2) VALUES('$fullName', '$userName', '$email', '$upassword', '$upassword2')");
          $_SESSION["userName"] = $userName;
          // echo "Hello $firstName, you successfully created your account!";
          header("Location: login.php");
        }
      }
    ?>
    <main class="card-wrapper">
      <div class="card-container">
        <h2>Sign up with your email</h2>
        <h4>Already have an account?<span><a href="sign-in.php" target="_blank">&nbsp;Sign in</a></span></h4>
        <div class="warning-texts">
          <?php
          if(isset($_POST["submit"])){
            if(strlen($fullName) === 0){
              echo "<ul><li>Name can't be blank</li>";
            }
            if(strlen($userName) === 0){
              echo "<li>Username can't be blank</li>";
            }
            if(strlen($email) === 0){
              echo "<li>Email can't be blank</li>";
            }
            if(strlen($upassword) === 0){
              echo "<li>Password can't be blank</li></ul>";
            }
          }
          ?>
        </div>
        <form action="index.php" method="post" autocomplete>
          <div class="input-wrapper">
            <div class="input-container">
              <label for="">Name</label>
              <input type="text" name="fullName"/>
            </div>
            <div class="input-container">
              <label for="">Username</label>
              <input type="text" name="userName"/>
            </div>
          </div>
          <div class="input-container full-width-input">
            <label for="">Email</label>
            <input type="email" name="email"/>
          </div>
          <div class="input-container full-width-input">
            <label class="label-inline" for=""><p>Password&nbsp;&nbsp;</p>
            <?php
            if(isset($_POST["submit"])){
              if($upassword !== $upassword2){
                echo "<span>*Passwords don't match</span>";
              } else if($upassword === $upassword2 && strlen($upassword) <= 6 && strlen($upassword) > 0){
                echo "<span>*Password is too short</span>";
              }
            }
            ?>
            </label>
            <input type="password" name="upassword" placeholder="6+ characters" />
          </div>
          <div class="input-container full-width-input">
            <label for="">Confirm Password</label>
            <input type="password" name="upassword2" placeholder="6+ characters" />
          </div>
          <button type="submit" name="submit">Create Account</button>
        </form>
      </div>
    </main>
    <p><a href="registration.php" target="_blank">Registration</a></p>
  </body>
</html>
