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
<html lang="en">

<head>
  <title>MENU</title>
  <link rel="stylesheet" href="../CSS_JS/faciinfo.css">
  <style>
    body {
      background-color: #f1f1f1;
      color: #1b9284;
      font-family: Arial, sans-serif;
    }

    .button {
      background-color: #1b9284;
      border: none;
      color: rgb(255, 255, 255);
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      border-radius: 25px;
    }

    .main {
      text-align: center;
      margin-top: 30px;
    }

    .pill-nav {
      background-color: #f1f1f1;
      overflow: hidden;
    }

    .pill-nav a {
      color: #1b9284;
      float: left;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      font-size: 17px;
    }

    .pill-nav a.active {
      background-color: #1b9284;
      color: white;
    }

    .pill-nav a:hover {
      background-color: #ddd;
      color: #1b9284;
    }

    h1 {
      color: #1b9284;
    }

    .row {
      display: flex;
      flex-wrap: wrap;
      padding: 0 4px;
    }

    .column {
      flex: 25%;
      max-width: 25%;
      padding: 0 4px;
    }

    .column .content {
      background-color: white;
      margin-bottom: 15px;
      padding: 15px;
      text-align: center;
    }

    .content h3 {
      color: #1b9284;
      text-align: center;
    }
  </style>
</head>

<body>
  <div class="main">
    <div class="pill-nav">
      <a style="color: #1b9284;" href="home.php">Home</a>;
      <a style="color: white;" href="menuGP.php" class="active">Menu</a>
      <a style="color: #1b9284;" href="faci_info.php">Facilities</a>
      <a style="color: #1b9284;" href="logout.php">Logout</a>
    </div>
    <h1>IIUM SPORT CENTRE</h1>
    <hr>

    <!-- Portfolio Gallery Grid -->
    <div class="row">
      <div class="column">
        <div class="content">
          <h3>BADMINTON</h3>
          <img src="../asset/badminton.jpg" alt="badminton" style="width:100%">
          <center>
            <button type="button" class="button" style="margin-top: 15px;" onclick="redirect('badminton')">Book</button>
          </center>
        </div>
      </div>

      <div class="column">
        <div class="content">
          <h3>TENNIS</h3>
          <img src="../asset/tennis.jpg" alt="tennis" style="width:100%">
          <center>
            <button type="button" class="button" style="margin-top: 15px;" onclick="redirect('tennis')">Book</button>
          </center>
        </div>
      </div>

      <div class="column">
        <div class="content">
          <h3>FUTSAL</h3>
          <img src="../asset/futsal court.jfif" alt="futsal" style="width:100%">
          <center>
            <button type="button" class="button" style="margin-top: 15px;" onclick="redirect('futsal')">Book</button>
          </center>
        </div>
      </div>

      <div class="column">
        <div class="content">
          <h3>SWIMMING</h3>
          <img src="../asset/swimming pool.jfif" alt="swimming" style="width:100%">
          <center>
            <button type="button" class="button" style="margin-top: 15px;" onclick="redirect('swimming')">Book</button>
          </center>
        </div>
      </div>
      <!-- END MAIN -->
    </div>

  </div>

</body>

</html>

<script>
  function redirect(sport) {
    window.location.href = "confirm.php?sport=" + encodeURIComponent(sport);
  }
</script>