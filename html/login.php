<?php
require_once('../app/config.php');
session_start();

// Generate CSRF token if it doesn't exist
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user has submitted the form
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['csrf_token'])) {
        // Validate CSRF token
        if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
            // Show error message and redirect to login page
            exit('Error: Invalid CSRF token.');
        } else {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Whitelist validation using regex
            $username_pattern = '/^[a-zA-Z0-9_]{3,20}$/'; // Allow alphanumeric and underscore, 3-20 characters
            $password_pattern = '/^[a-zA-Z0-9!@#$%^&*()]{8,}$/'; // Allow alphanumeric and some special characters, minimum 8 characters

            // Validate username against whitelist pattern
            if (!preg_match($username_pattern, $username)) {
                echo "<script>alert('Invalid username format. Please try again.'); window.location.href = 'login.php';</script>";
                exit();
            }

            // Retrieve user from database (replace with your own method)
            $conn = mysqli_connect($database_host, $database_user, $database_password, $database_name);
            $username = mysqli_real_escape_string($conn, $username);
            $query = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($conn, $query);

            // Check if user exists in the database
            if (mysqli_num_rows($result) == 1) {
                $user = mysqli_fetch_assoc($result);
                $db_password = $user['password'];

                // Validate password against whitelist pattern
                if (!preg_match($password_pattern, $password)) {
                    echo "<script>alert('Invalid password format. Please try again.'); window.location.href = 'login.php';</script>";
                    exit();
                }

                // Verify password
                if (password_verify($password, $db_password)) {
                    // Login successful, generate random session ID
                    $session_id = bin2hex(random_bytes(16));

                    // Save user session with random session ID and last activity time
                    $_SESSION['username'] = $username;
                    $_SESSION['session_id'] = $session_id;
                    $_SESSION['last_activity'] = time();

                    // Redirect to home.php or privilege.php if the username is "admin"
                    if ($username === 'admin') {
                        header("Location: privilege.php");
                    } else {
                        header("Location: menuGP.php");
                    }
                    exit();
                } else {
                    // Wrong password, display error message
                    echo "<script>alert('Wrong password. Please try again.'); window.location.href = 'login.php';</script>";
                }
            } else {
                // No username exists, display error message
                echo "<script>alert('Invalid username. Please try again.'); window.location.href = 'login.php';</script>";
               
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>User Authentication</title>
    <link rel="stylesheet" href="../CSS_JS/loginGP.css" />
    <script src="../CSS_JS/loginGP.js" charset="utf-8"></script>
  </head>

  <body>
  <form class="box" action="login.php" method="post" onsubmit="return validateForm()">
    <h1>LOG IN TO YOUR ACCOUNT</h1>

    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($_SESSION['csrf_token']); ?>">

    <input type="submit" value="LOG IN"/>

    <div class="signup_link">
      Don't have an account? <a href="registerGP.php">Sign Up</a>
    </div>
  </form>

  <script>
    function validateForm() {
      // Valid font families
      var validFontFamilies = [
        "-apple-system",
        "BlinkMacSystemFont",
        "Segoe UI",
        "Roboto",
        "Oxygen-Sans",
        "Ubuntu",
        "Cantarell",
        "Helvetica Neue",
        "sans-serif"
      ];

      // Validate font family
      var inputs = document.getElementsByTagName("input");

      for (var i = 0; i < inputs.length; i++) {
        var font = window.getComputedStyle(inputs[i], null).getPropertyValue("font-family");

        if (!isValidFontFamily(font)) {
          alert("Please use the system default font for input fields.");
          inputs[i].focus();
          return false;
        }
      }

      return true;
    }

    function isValidFontFamily(fontFamily) {
      for (var i = 0; i < validFontFamilies.length; i++) {
        if (fontFamily.includes(validFontFamilies[i])) {
          return true;
        }
      }
      return false;
    }
  </script>
</body>

</html>
