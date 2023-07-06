<?php
require_once('../html/idle.php');
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Confirm Booking</title>
    <link rel="stylesheet" href="../CSS_JS/loginGP.css">

    <style>
        /* CSS styles here */
    </style>
</head>

<body>
    <div class="pill-nav">
        <!-- Navigation links here -->
    </div>

    <div class="box">
        <div class="inner-box">
            <form method="POST" action="process_booking.php">
                <label for="bookingType">Booking Type:</label>
                <select id="bookingType" name="bookingType">
                    <option value="badminton">Badminton</option>
                    <option value="tennis">Tennis</option>
                    <option value="futsal">Futsal</option>
                    <option value="swimming">Swimming</option>
                </select>
                <br><br>

                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" name="fullName" required pattern="[a-zA-Z ]+">

                <br><br>

                <label for="matricID">Matric ID:</label>
                <input type="text" id="matricID" name="matricID" required pattern="[a-zA-Z0-9]+">

                <br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <br><br>

                <label for="timeSlot">Time Slot:</label>
                <select id="timeSlot" name="timeSlot" required>
                    <option value="" selected disabled>Select a time slot</option>
                    <option value="8-10">8 a.m - 10 a.m</option>
                    <option value="10:30-12:30">10:30 a.m - 12:30 p.m</option>
                    <option value="14-16">2:00 p.m - 4:00 p.m</option>
                    <option value="16:30-18:30">4:30 p.m - 6:30 p.m</option>
                </select>
                <br><br>

                <label for="contactNumber">Contact Number:</label>
                <input type="tel" id="contactNumber" name="contactNumber" required pattern="[0-9]+">
                <br><br>

                <label for="participants">Number of Participants:</label>
                <input type="number" id="participants" name="participants" required min="1">
     
                <input type="submit" value="Confirm Booking">
            </form>
        </div>
    </div>

    <script>
        // JavaScript code here
    </script>
</body>

</html>
