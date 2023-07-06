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
