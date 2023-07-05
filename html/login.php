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
                // Login successful, generate random session ID
                $session_id = bin2hex(random_bytes(16));

                // Disable output buffering
                while (ob_get_level()) {
                    ob_end_flush();
                }

                // Save user session with random session ID and last activity time
                $_SESSION['username'] = $username;
                $_SESSION['session_id'] = $session_id;
                $_SESSION['last_activity'] = time();

                // Redirect to home.php or privilege.php if the username is "admin"
                if ($username === 'admin') {
                    header("Location: privilege.php");
                } else {
                    header("Location: menuGP.html");
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
} else {
    // Check if session is active
    if (isset($_SESSION['username'])) {
        // Check if last activity timestamp is set
        if (isset($_SESSION['last_activity'])) {
            // Get the current timestamp
            $currentTimestamp = time();

            // Get the idle timeout in seconds
            $idleTimeout = 60; // 1 minute

            // Calculate the idle time
            $idleTime = $currentTimestamp - $_SESSION['last_activity'];

            if ($idleTime >= $idleTimeout) {
                // Session is idle, destroy it and redirect to login page
                session_unset();
                session_destroy();
                header("Location: loginGP.html?error=Session expired due to inactivity.");
                exit();
            } else {
                // Update last activity timestamp
                $_SESSION['last_activity'] = $currentTimestamp;
            }
        } else {
            // Set the last activity timestamp
            $_SESSION['last_activity'] = time();
        }
    } else {
        // Session is not active, redirect to login page
        header("Location: loginGP.html");
        exit();
    }
}
?>
