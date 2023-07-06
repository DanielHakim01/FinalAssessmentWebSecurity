<h2 align="center">
INFO 4345 WEB APPLICATION SECURITY <br> <br>
TITLE: IIUM SPORT CENTRE <br> <br>
SEM 2 2022/2023 <br> <br>
GROUP ADHD <br> <br>

GROUP MEMBER: <br> <br>
 MUHAMMAD DANIEL HAKIM BIN MOHD SUHAIMI 2018451 <br> <br>
 ONG <br> <br>
 ABU <br> <br>
 DIN <br> <br>
</h2>

## INTRODUCTION

This project is to apply secure web development that we have learnt to an existing past project. <br>
In this project we decided to add security measures on a past web technology project. <br>
This project is also aim to create a functional web application instead of a static HTML website. <br>
This web application is to help IIUM students to easily book venue or facilities provided in the IIUM sport centre both for Female sport centre and Male sport centre. <br>
This website originally is just a static website with no authentication or authorization mechanism and database to store any user credentials and booking made. Our job is to transform this website into a functional web application with secure web development approach.

## OBJECTIVE

## WEB APPLICATION SECURITY ENHANCEMENTS

We will be implementing these security enhancements into the web application.
1. Input Validation
2. Authentication
3. Authorization
4. XSS and CSRF Prevention
5. Database Security Principles
6. File Security Principles

### 1. Input Validation
### 2. Authentication

In this part, we will be implementing Authentication measures. <br>
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

Once user successfully registered their password will be hashed and stored in the database. <br>

------
            if(isset($_POST['username']) && isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            
            // Check if the username already exists in the database
            $sql_check = "SELECT * FROM users WHERE username='$username'";
            $result_check = mysqli_query($conn, $sql_check);
       
           if (mysqli_num_rows($result_check) > 0) {
               // Show error message and redirect to registration page
               echo "<script>showError('Error: Username already exists. Please choose a different username.');</script>";
             } elseif (strlen($password) < 8) {
               // Show error message and redirect to registration page
               echo "<script>showError('Error: Password must be at least 8 characters long. Please try again.');</script>";
             } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $username)) {
               // Show error message and redirect to registration page
               echo "<script>showError('Error: Username must contain only letters and numbers. Please try again.');</script>";
             } else {
               // Insert the username and hashed password into the database
               $hashed_password = password_hash($password, PASSWORD_DEFAULT);
               $sql = "INSERT INTO users (username, password) VALUES ('$username','$hashed_password')";
               $result = mysqli_query($conn, $sql);
       
               if ($result) {
                 // Get the generated ID
                 $id = mysqli_insert_id($conn);
                 // Registration successful, display success message and redirect to login page
                 echo "<script>alert('User registration successful! Please login.');</script>";
                 header("Location: ../html/loginGP.html? success=User registration successful! Please login.");
                 exit();
             }
              else {
                 // Show error message and redirect to registration page
                 echo "<script>showError('Error: Could not register user. Please try again.');</script>";
               }
             }
           }
------

### 3. Authorization
### 4. XSS and CSRF Prevention
### 5. Database Security Principles
### 6. File Security Principles


