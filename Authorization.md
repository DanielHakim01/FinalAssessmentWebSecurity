### 3. Authorization

In this part we will be implementing Authorization which are:
1. Session ID
2. Session management
3. Idle timeout
4. Using cryptographically Random Session IDs.

First, user need to enter their username and passwrd to continue.

-----------------
      <form class="box" action="login.php" method="post">
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
        Dont have an account?<a href="registerGP.php"> Sign Up </a>
      </div>

      </form>
---------------------

![](screenshot/loginpage.png)

Once user click the log in button it wil call the [login.php](login.php) <br>

---------------------
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user has submitted the form

    $conn = mysqli_connect($database_host, $database_user, $database_password, $database_name);
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Whitelist validation using regex
        $username_pattern = '/^[a-zA-Z0-9_]{3,20}$/'; // Allow alphanumeric and underscore, 3-20 characters
        $password_pattern = '/^[a-zA-Z0-9!@#$%^&*()]{8,}$/'; // Allow alphanumeric and some special characters, minimum 8 characters

        // Validate username against whitelist pattern
        if (!preg_match($username_pattern, $username)) {
            echo '<script>alert("Invalid username format."); window.location.href = "loginGP.html";</script>';
            exit();
        }

        // Retrieve user from database
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        // Check if user exists in the database
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $db_password = $row['password'];

            // Validate password against whitelist pattern
            if (!preg_match($password_pattern, $password)) {
                echo '<script>alert("Invalid password format."); window.location.href = "loginGP.html";</script>';
                exit();
            }

            // Verify password
            if (password_verify($password, $db_password)) {

                // Login successful, generate random session ID
                $session_id = bin2hex(random_bytes(16));

                // // Disable output buffering
                // while (ob_get_level()) {
                //     ob_end_flush();
                // }

                // // Save user session with random session ID and last activity time
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
                echo '<script>alert("Wrong password. Please try again."); window.location.href = "loginGP.html";</script>';
            }
        } else {
            // No username exists, display error message
            echo '<script>alert("Invalid username. Please try again."); window.location.href = "loginGP.html";</script>';
            exit();
        }
    }
// 
}
---------------------
