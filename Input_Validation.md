### 1. Input Validation

Input elements we have validated for example are username and password, in client-side and server-side.

## Early Validation

In registerGP.php

-----
           <label for="username">Username:</label>
            <input type="text" id="username" name="username"  pattern="[a-z0-9]+" required><br><br>
      
      
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" minlength="8" required><br><br>
-----      

## Late Validation

-----
           $bookingType = filter_var($_POST['bookingType'], FILTER_SANITIZE_STRING);
            $fullName = filter_var($_POST['fullName'], FILTER_SANITIZE_STRING);
            $matricID = filter_var($_POST['matricID'], FILTER_SANITIZE_NUMBER_INT);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $timeSlot = filter_var($_POST['timeSlot'], FILTER_SANITIZE_STRING);
            $contactNumber = filter_var($_POST['contactNumber'], FILTER_SANITIZE_STRING);
            $participants = filter_var($_POST['participants'], FILTER_SANITIZE_NUMBER_INT);

-----     
