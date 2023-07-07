<?php
require_once('../app/config.php');
session_start();
// connect to database

// connect to the database
$conn = mysqli_connect($database_host, $database_user, $database_password, $database_name);

if (!isset($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
// check if user has submitted the form
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['csrf_token'])) {
  // Validate CSRF token
  if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    // Show error message and redirect to registration page
    echo "<script>showError('Error: Invalid CSRF token.');</script>";
    exit();
  }

  $username = $_POST['username'];
  $password = $_POST['password'];

  // Check if the username already exists in the database
  $sql_check = "SELECT * FROM users WHERE username='$username'";
  $result_check = mysqli_query($conn, $sql_check);

  if (mysqli_num_rows($result_check) > 0) {
    // Show error message and redirect to registration page
    echo "<script>showError('Error: Username already exists. Please choose a different username.'); window.location.href = 'registerGP.php';</script>";
    exit();
  } elseif (strlen($password) < 8) {
    // Show error message and redirect to registration page
    echo "<script>showError('Error: Password must be at least 8 characters long. Please try again.'); window.location.href = 'registerGP.php';</script>";
    exit();
  } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
    // Show error message and redirect to registration page
    echo "<script>showError('Error: Username must contain only letters and numbers. Please try again.'); window.location.href = 'registerGP.php';</script>";
    exit();
  } else {
    if (!preg_match('/^[a-zA-Z0-9!@#$%^&*()_]{8,}$/', $password)) {
      echo "<script>showError('Error: Incorrect Password Format. Please try again.'); window.location.href = 'registerGP.php';</script>";
      exit();
    } else {
      // Insert the username and hashed password into the database
      $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO users (username, password) VALUES ('$username','$hashed_password')";
      $result = mysqli_query($conn, $sql);
    }

    if ($result) {
      // Get the generated ID
      $id = mysqli_insert_id($conn);
      // Registration successful, display success message and redirect to login page
      echo "<script>alert('User registration successful! Please login.'); window.location.href = 'login.php';</script>";
      exit();
    } else {
      // Show error message and redirect to registration page
      echo "<script>showError('Error: Could not register user. Please try again.');</script>";
      exit();
    }
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>User Registration</title>
  <link rel="stylesheet" href="../CSS_JS/loginGP.css" />
  <script src="../CSS_JS/loginGP.js" charset="utf-8"></script>

</head>

<body>
  <form class="box" action="registerGP.php" method="post">
    <h1>CREATE AN ACCOUNT</h1>

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>


    <label for="password">Password:</label>
    <input type="password" id="password" name="password" minlength="8" required><br><br>

    <input type="hidden" name="csrf_token"
      value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">


    <div class="password"><br>

    </div>


    <input type="submit" class="btn btn-primary" value="Register"></button>

    <div class="signup_link">
      Already a member?<a href="login.php"> Log In </a>
    </div>

  </form>
</body>

</html>