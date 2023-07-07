<?php
require_once('../html/idle.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title>IIUM SPORT RESERVATION CENTRE</title>
  <link rel="stylesheet" href="../CSS_JS/faciinfo.css">
  <style>
    body {
      background-color: #f1f1f1;
      color: #1b9284;
      font-family: Arial, sans-serif;
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

    h1,
    h2,
    h3,
    p {
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
  </style>
</head>

<body>
  <div class="main">
    <div class="pill-nav">
      <a style="color: #1b9284;" href="home.php">Home</a>;
      <a style="color: #1b9284;" href="menuGP.php">Menu</a>
      <a style="color: white;" href="faci_info.php" class="active">Facilities</a>
      <a style="color: #1b9284;" href="login.php">Logout</a>

    </div>
    <h1>IIUM SPORT CENTRE</h1>
    <hr>

    <h2>FACILITIES INFORMATION</h2>

    <!-- Portfolio Gallery Grid -->
    <div class="row">
      <div class="column">
        <div class="content">
          <img src="../asset/badminton.jpg" alt="badminton" style="width:100%">
          <h3>BADMINTON</h3>
          <p>Operation Hours: 8am - 10pm</p>
          <p>Must be fully vaccinated.</p>
          <p>Located @ FSC & MSC</p>
        </div>
      </div>

      <div class="column">
        <div class="content">
          <img src="../asset/tennis.jpg" alt="tennis" style="width:100%">
          <h3>TENNIS COURT</h3>
          <p>Operation Hours: 8am - 10pm</p>
          <p>Must be fully vaccinated.</p>
          <p>Located @ FSC & MSC</p>
        </div>
      </div>

      <div class="column">
        <div class="content">
          <img src="../asset/futsal court.jfif" alt="futsal" style="width:100%">
          <h3>FUTSAL</h3>
          <p>Operation Hours: 8am - 10pm</p>
          <p>Must be fully vaccinated.</p>
          <p>Located @ FSC & MSC</p>
        </div>
      </div>

      <div class="column">
        <div class="content">
          <img src="../asset/swimming pool.jfif" alt="swimming pool" style="width:100%">
          <h3>Swimming Pool</h3>
          <p>Operation Hours: 8am - 10pm</p>
          <p>Must be fully vaccinated.</p>
          <p>Located @ FSC & MSC</p>
        </div>
      </div>
    </div>
  </div>
</body>

</html>