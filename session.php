<?php
  session_start(); 

  require_once "database.php";

  if (!isset($_SESSION['email'])) {
  echo  $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: login.php");
  }

  $email = $_SESSION['email'];
    $query = "SELECT * FROM users WHERE email='$email'";
    $results = mysqli_query($db, $query);
    $user = mysqli_fetch_assoc($results);
?>