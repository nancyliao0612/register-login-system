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
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $upassword = $_POST["upassword"];
        $upassword2 = $_POST["upassword2"];

        if($upassword != $upassword2){
          echo "passwords don't match";
        }
        else{
        $db = new mysqli("us-cdbr-east-05.cleardb.net", "ba8a20c077011f", "a2f82246", "heroku_348200725298d23");
        $result = $db -> query("INSERT INTO users(firstName, lastName, upassword) VALUES('$firstName', '$lastName', '$upassword')");

        echo "Hello $firstName, you successfully created your account!";
        }
      }
    ?>
    <main class="card-wrapper">
      <div class="card-container">
        <h2>Sign up with your email</h2>
        <h4>Already have an account?<span><a href="login.php" target="_blank">&nbsp;Sign in</a></span></h4>
        <form action="index.php" method="post">
          <div class="input-wrapper">
            <div class="input-container">
              <label for="">First Name</label>
              <input type="text" name="firstName"/>
            </div>
            <div class="input-container">
              <label for="">Last Name</label>
              <input type="text" name="lastName"/>
            </div>
          </div>
          <div class="input-container full-width-input">
            <label for="">Email</label>
            <input type="email" required name="email"/>
          </div>
          <div class="input-container full-width-input">
            <label for="">Password</label>
            <input type="password" name="upassword"/>
          </div>
          <div class="input-container full-width-input">
            <label for="">Confirm Password</label>
            <input type="password" name="upassword2"/>
          </div>
          <button name="submit">Create Account</button>
        </form>
      </div>
    </main>
    <p><a href="registration.php" target="_blank">Registration</a></p>
  </body>
</html>
