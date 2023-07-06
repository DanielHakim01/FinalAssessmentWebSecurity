### 3. Authorization

In this part we will be implementing Authorization which are:
1. Session ID using cryptographically secure random number generator (CSPRNG)
2. Session management
3. Idle timeout
4. Log out

First, user need to enter their username and password to continue.

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

Once user click the log in button it wil call the [login.php](html/login.php) <br>
Here, username and password will be compared to the username and hashed password in the database. <br>

---------------------
    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
    // Check if user has submitted the form

    $conn = mysqli_connect($database_host, $database_user, $database_password, $database_name);
    if (isset($_POST['username']) && isset($_POST['password'])) 
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Whitelist validation using regex
        $username_pattern = '/^[a-zA-Z0-9_]{3,20}$/'; // Allow alphanumeric and underscore, 3-20 characters
        $password_pattern = '/^[a-zA-Z0-9!@#$%^&*()]{8,}$/'; // Allow alphanumeric and some special characters, minimum 8 characters

        // Validate username against whitelist pattern
        if (!preg_match($username_pattern, $username)) 
        {
            echo '<script>alert("Invalid username format."); window.location.href = "loginGP.html";</script>';
            exit();
        }

        // Retrieve user from database
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        // Check if user exists in the database
        if (mysqli_num_rows($result) == 1) 
        {
            $row = mysqli_fetch_assoc($result);
            $db_password = $row['password'];

            // Validate password against whitelist pattern
            if (!preg_match($password_pattern, $password)) 
            {
                echo '<script>alert("Invalid password format."); window.location.href = "loginGP.html";</script>';
                exit();
            }

                // Verify password
            if (password_verify($password, $db_password)) 
            {
                // where session code will be
                
                // Redirect to home.php or privilege.php if the username is "admin"
                if ($username === 'admin') {
                    header("Location: privilege.php");
                } else {
                    header("Location: menuGP.php");
                }
                exit();
            } 
            else 
            {
                // Wrong password, display error message
                echo '<script>alert("Wrong password. Please try again."); window.location.href = "loginGP.html";</script>';
            }
        } 
        else 
        {
            // No username exists, display error message
            echo '<script>alert("Invalid username. Please try again."); window.location.href = "loginGP.html";</script>';
            exit();
        }
     }
    }
---------------------

If Username or pasword did not match or wrong, a window will pop out. <br>

![](screenshot/loginCannot.png)

User will need to enter the correct username and password in order for them to access the web application. <br><br>

If Login is successful, session ID will be created using cryptographically Random Session IDs.<br>
When true is pass as the argument to session_regenerate_id(), it instructs PHP to use a CSPRNG to generate a new session ID.<br>
PHP uses the underlying operating system's CSPRNG, which ensures that the generated session ID is highly unpredictable and suitable for secure session management. This helps protect against session fixation attacks and enhances the security of application.<br>

---------------------
       // Login successful, generate random session ID
                session_regenerate_id(true);
                $session_id = session_id();
---------------------

This session id will be handled by the $_SESSION super array. <br>
The username, session id and activity of each session will be recorded.

---------------------

                // // Disable output buffering
                // while (ob_get_level()) {
                //     ob_end_flush();
                // }

                // // Save user session with random session ID and last activity time
                $_SESSION['username'] = $username;
                $_SESSION['session_id'] = $session_id;
                $_SESSION['last_activity'] = time();
---------------------

Once user have been authenticate and authorized, user will be redirected to the home page. <br>
The [idle.php](html/idle.php) is responsible for the idle timeout. <br>
Here a timer will be assigned, if user is not active within 60 seconds, user will be log out automatically and their session will be destroyed. <br>
While if user is active, their session will continue until the last-activity did not detect any activity. <br>

---------------------
            session_start();
            
            // Get the idle timeout in seconds
            $idleTimeout = 60; // 1 minute
              
                
            // Check if session is active
            if (isset($_SESSION['username'])) 
            {
              // Check if last activity timestamp is set
              if (isset($_SESSION['last_activity'])) 
              {
                // Get the current timestamp
                $currentTimestamp = time();
              
            
                // Calculate the idle time
                $idleTime = $currentTimestamp - $_SESSION['last_activity'];
              
                if ($idleTime >= $idleTimeout) 
                {
                  // Session is idle, destroy it and redirect to login page
                  session_unset();
                  session_destroy();
                  session_write_close(); // Close the session file
                  setcookie(session_name(), '', 0, '/'); // Destroy the session cookie
                  echo '<script>alert("Session Expired"); window.location.href = "loginGP.html";</script>';
                  exit();       
                } 
                else 
                {
                  // Update last activity timestamp
                 $_SESSION['last_activity'] = $currentTimestamp;    
                }
                      
              } else 
              {
                // Set the last activity timestamp
                 $_SESSION['last_activity'] = time();
                      
              }
            } else       
            {
              // Session is not active, redirect to login page
              header("Location: loginGP.html");
              exit();
                    
            }
---------------------

A pop out will be shown when a user is in idle.

![](screenshot/sessionEx.png)

This line will be needed in every php code in order to call the [idle.php](html/idle.php)

---------------------

      <?php
      require_once('../html/idle.php');  
      ?>  

---------------------
