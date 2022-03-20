<?php
session_start();
if(!isset($_SESSION["check"])){
  header("Location: index.php");
}
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
    <main class="card-wrapper">
      <div class="card-container">   
        <?php
        echo "<h2>👋 Hi " . $_SESSION['userName'] . "! You successfully log in.</h2>";
        ?>
        <button><a href="logout.php">Logout</a></button>
      </div>
    </main>
  </body>
</html>
