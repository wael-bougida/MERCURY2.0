<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saturn</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel='stylesheet' type='text/css' media='screen' href='../../CSS/main.css'>
</head>
<body>
  
<section id="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="../../index.php">
        <img src="../../img/saturn_blue.png" width="30" height="30" class="d-inline-block align-top " alt="logo">
        Saturn
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="../../index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../imprint.php">Imprint</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../maintenance.php">Maintenance Page</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="../../search.php">Search Page</a>
          </li>
        
        <?php
          if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            echo " 
          <li class='nav-item'>
            <a class='nav-link' href='../../logout.php'> Log out</a>
          </li>";
          }else{
            echo " 
          <li class='nav-item'>
            <a class='nav-link' href='../../login.php'> Log in</a>
          </li>";
          }
          ?>

</ul>
      </div>
    </nav>
  </section>