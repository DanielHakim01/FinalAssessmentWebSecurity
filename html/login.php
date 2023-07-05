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

        // Whitelist validation using regex
        $username_pattern = '/^[a-zA-Z0-9_]{3,20}$/'; // Allow alphanumeric and underscore, 3-20 characters
        $password_pattern = '/^[a-zA-Z0-9!@#$%^&*()]{8,}$/'; // Allow alphanumeric and some special characters, minimum 8 characters

        // Validate username against whitelist pattern
        if (!preg_match($username_pattern, $username)) {
            header('Location: loginGP.html?error=Invalid username format.');
            exit();
        }

        // Validate password against whitelist pattern
        if (!preg_match($password_pattern, $password)) {
            header('Location: loginGP.html?error=Invalid password format.');
            exit();
        }

        // Retrieve user from database
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);

        // Check if user exists in the database
        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);
            $db_password = $row['password'];

            // Verify password
            if (password_verify($password, $db_password)) {
                // Login successful, generate random session ID
                $session_id = bin2hex(random_bytes(16));

                // Disable output buffering
                // while (ob_get_level()) {
                //     ob_end_flush();
                // }

                // Print the session ID
                echo "Session ID: " . $session_id . "<br>";

                // Save user session with random session ID
                $_SESSION['username'] = $username;
                $_SESSION['session_id'] = $session_id;

                // Redirect to home.php or privilege.php if the username is "admin"
                if ($username === 'admin') {
                    header("Location: privilege.php");
                } else {
                    header("Location: Main_Page.html");
                }
                exit();
            } else {
                // Login failed, display error message
                header('Location: loginGP.html?error=Invalid username or password.');
                exit();
            }
        } else {
            // Login failed, display error message
            header('Location: loginGP.html?error=Invalid username.');
            exit();
        }
    }
}
?>
