<?php
require_once('../app/config.php');
require_once('../html/idle.php');


$conn = mysqli_connect($database_host, $database_user, $database_password, $database_name);


// Retrieve form data and sanitize it
$bookingType = filter_var($_POST['bookingType'], FILTER_SANITIZE_STRING);
$fullName = filter_var($_POST['fullName'], FILTER_SANITIZE_STRING);
$matricID = filter_var($_POST['matricID'], FILTER_SANITIZE_NUMBER_INT);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$timeSlot = filter_var($_POST['timeSlot'], FILTER_SANITIZE_STRING);
$contactNumber = filter_var($_POST['contactNumber'], FILTER_SANITIZE_STRING);
$participants = filter_var($_POST['participants'], FILTER_SANITIZE_NUMBER_INT);

// Validate the sanitized data
if (
    $bookingType !== false &&
    $fullName !== false &&
    $matricID !== false &&
    $email !== false &&
    $timeSlot !== false &&
    $contactNumber !== false &&
    $participants !== false
) {
    // Prepare and execute the SQL query to insert the data into the database
    $sql = "INSERT INTO `booking`
            (`bookingType`, `fullName`, `matricID`, `email`, `timeSlot`, `contactNumber`, `participants`)
            VALUES ('$bookingType', '$fullName', '$matricID', '$email', '$timeSlot', '$contactNumber', '$participants')";

    if ($conn->query($sql) === TRUE) {
        echo "Booking Successful!";
        echo '<script>setTimeout(function() { window.location.href = "menuGP.php"; }, 3000);</script>';
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Invalid form data.";
}

// Close the database connection
$conn->close();
?>