<?php
require_once('../html/idle.php');
// Check if the CSRF token exists in the session
if (isset($_SESSION['csrf_token'])) {
    $csrf_token = $_SESSION['csrf_token'];
} else {
    // CSRF token is not found, redirect to login page
    echo '<script>alert("Error: CSRF token not found."); window.location.href = "login.php";</script>';
    exit();
}
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Confirm Booking</title>
    <link rel="stylesheet" href="../CSS_JS/loginGP.css">

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .pill-nav a {
            display: inline-block;
            color: white;
            text-align: center;
            padding: 14px;
            text-decoration: none;
            font-size: 17px;
            border-radius: 5px;
        }

        /* Change the color of links on mouse-over */
        .pill-nav a:hover {
            background-color: black;
            color: white;
        }

        /* Add a color to the active/current link */
        .pill-nav a.active {
            background-color: black;
            color: white;
        }

        .button {
            background-color: #ffffff;
            /* Green */
            border: none;
            color: black;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 25px;
            font-weight: bold;
        }

        .box {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .inner-box {
            width: 400px;
            padding: 20px;
            border: 1px solid black;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="pill-nav">
        // Use HTML tag number 2 for Home button
        <a style="color: #1b9284;" href="home.php">Home</a>;
        <a href="loginGP.html">Login</a>
        <a href="menuGP.html">Menu</a>
        <a href="procedure.html">Procedure</a>
        <a href="faci_info.html">Facilities</a>
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
                <input type="text" id="fullName" name="fullName" pattern="[A-Za-z ]+"
                    title="Please enter letters and spaces only" required>

                <br><br>

                <label for="matricID">Matric ID:</label>
                <input type="text" id="matricID" name="matricID" pattern="[0-9]+" title="Please enter numbers only"
                    required>
                <br><br>

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
                <input type="tel" id="contactNumber" name="contactNumber" required>
                <br><br>

                <label for="participants">Number of Participants:</label>
                <input type="number" id="participants" name="participants" required>
                <br><br>
                <input type="hidden" name="csrf_token"
                    value="<?php echo htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8'); ?>">
                <input type="submit" value="Confirm Booking">
            </form>
        </div>

    </div>

    <script>
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const sport = urlParams.get('sport');
        const bookingTypeSelect = document.getElementById("bookingType");

        if (sport === "futsal") {
            bookingTypeSelect.selectedIndex = 2;
        } else if (sport === "swimming") {
            bookingTypeSelect.selectedIndex = 3;
        } else if (sport === "badminton") {
            bookingTypeSelect.selectedIndex = 0;
        }
        else {
            bookingTypeSelect.selectedIndex = 1
        }

    </script>
</body>

</html>