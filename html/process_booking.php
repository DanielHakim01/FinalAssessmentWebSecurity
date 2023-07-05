<?php
require_once('../app/config.php');



$conn = mysqli_connect($database_host, $database_user, $database_password, $database_name);


// Retrieve form data
$bookingType = $_POST['bookingType'];
$fullName = $_POST['fullName'];
$matricID = $_POST['matricID'];
$email = $_POST['email'];
$timeSlot = $_POST['timeSlot'];
$contactNumber = $_POST['contactNumber'];
$participants = $_POST['participants'];

// Prepare and execute the SQL query to insert the data into the database
$sql = "INSERT INTO `booking`
(`bookingType`,
 `fullName`, 
 `matricID`,
  `email`,
  `timeSlot`, 
  `contactNumber`, 
  `participants`) 
VALUES ('$bookingType', '$fullName', '$matricID', '$email', '$timeSlot', '$contactNumber', $participants)";




if ($conn->query($sql) === TRUE) {
    echo "Booking confirmed successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
