<?php
require_once('../html/idle.php');  
?>  

<!DOCTYPE html>
<html lang="en">
<head>
  <title>IIUM SPORT RESERVATION  CENTRE</title>
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
      <a style="color: white;" href="home.php"  class="active">Home</a>
      <a style="color: #1b9284;" href="menuGP.php">Menu</a>
      <a style="color: #1b9284;" href="faci_info.php">Facilities</a>
      <a style="color: #1b9284;" href="logout.php">Logout</a>
    </div>
<centre>
<h1 >IIUM SPORT CENTRE</h1>
</centre>

</body>
</html>
