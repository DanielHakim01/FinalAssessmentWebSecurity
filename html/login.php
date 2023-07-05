<!-- <!DOCTYPE html>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="../CSS_JS/loginGP.css" />
    <script src="../CSS_JS/loginGP.js" charset="utf-8"></script>
  </head>

  <body>
    <form class="box" action="loginGP.html" method="post">
      <h1>LOG IN TO YOUR ACCOUNT</h1>

      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required><br><br>
      
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required><br><br>
      
      <div class="password">
        <a href="forgotpasswordGP.html">Forgot Password?</a>
      </div>
      
      <input type="submit" value="LOG IN"/>
      
      <div class="signup_link">
        Dont have an account?<a href="registerGP.html"> Sign Up </a>
      </div>

    </form>
  </body>
</html> -->

<?php   
session_start();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Check if user has submitted the form
    $database_host = 'localhost';
    $database_user = 'root';
    $database_password = '';
    $database_name = 'user_info';
    $conn = mysqli_connect($database_host, $database_user, $database_password, $database_name);

    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Retrieve user from database
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        // Check if user exists in the database
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $db_password = $row['password'];

            // Verify password
            if (password_verify($password, $db_password)) {
                // Login successful, save user session
                $_SESSION['username'] = $username;

                // Redirect to home.php or privilege.php if the username is "admin"
                if ($username === 'admin') {
                    header("Location: privilege.php");
                } else {
                    header("Location: studentForm.html");
                }
                exit();
            } else {
                // Login failed, display error message
                header('Location: login.html?error=Invalid username or password.');
                exit();
            }
        } else {
            // Login failed, display error message
            header('Location: login.html?error=Invalid username.');
            exit();
        }
    }
}
?>
