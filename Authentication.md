### 2. Authentication

In this part, we will be implementing Authentication measures which are:. <br>
1. Identification
2. Confirmation
3. Hashed password

Firstly, new user will need to register their account before they can access the web application. <br>
Here user needs to input their credentials such as username and password. <br>

------
            <form class="register" action="registerGP.php" method="post">
            <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username"  pattern="[a-z0-9]+" required>
            <span id="username-message" class="text-danger"></span>
            </div>

            <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" minlength="8" required>
            <span id="password-message" class="text-danger"></span>
            </div>
------

![](screenshot/register.png)

When user input their username and password and submitted the form, it will check in the database for any existing account with the same username.<br>

------
            if(isset($_POST['username']) && isset($_POST['password'])) 
            {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            // Check if the username already exists in the database
            $sql_check = "SELECT * FROM users WHERE username='$username'";
            $result_check = mysqli_query($conn, $sql_check);
       
            if (mysqli_num_rows($result_check) > 0) 
            {
                // Show error message and redirect to registration page
                echo "<script>showError('Error: Username already exists. Please choose a different username.');</script>";
            } 
            elseif (strlen($password) < 8) 
            {
                // Show error message and redirect to registration page
                echo "<script>showError('Error: Password must be at least 8 characters long. Please try again.');</script>";
            } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $username)) 
            {
                // Show error message and redirect to registration page
                echo "<script>showError('Error: Username must contain only letters and numbers. Please try again.');</script>";
------

If existing username is found, it will prompt a pop up window.

![](screenshot/userExist.png)

If username is not found it will be stored in the database. <br>
Their password will be hashed and stored in the database. <br>

------
              }
              else 
              {
               // Insert the username and hashed password into the database
               $hashed_password = password_hash($password, PASSWORD_DEFAULT);
               $sql = "INSERT INTO users (username, password) VALUES ('$username','$hashed_password')";
               $result = mysqli_query($conn, $sql);
       
               if ($result) 
               {
                 // Get the generated ID
                 $id = mysqli_insert_id($conn);
                 // Registration successful, display success message and redirect to login page
                 echo '<script>alert("User registration successful! Please login."); window.location.href = "loginGP.html";</script>' ;
                 exit();
               }
              else 
              {
                 // Show error message and redirect to registration page
                 echo "<script>showError('Error: Could not register user. Please try again.');</script>";
              }
             }
           }

------

 ![](screenshot/hashedpass.png)

If username is not found, then user will be registered.

![](screenshot/registerSuccess.png)

User will be redirected to the login page. <br><br>


User need to enter their username and password in order fer them to be authenticated.

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

User will need to enter the correct username and password in order for them to authenticated again. <br><br>
