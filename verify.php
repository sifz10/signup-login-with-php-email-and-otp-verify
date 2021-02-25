<?php

require 'session.php';

if(isset($_POST['email_code']))
{

if($user['emailVerify'] == $_POST['code'])
{
    $user_id = $user['id'];
    $query = "UPDATE users SET emailVerify= 1 WHERE id= '$user_id'";
    $results = mysqli_query($db, $query);
    unset($_SESSION['codeSend']);
}

}

if(isset($_POST['number_code']))
{

if($user['numberVerify'] == $_POST['code'])
{
    $user_id = $user['id'];
    $query = "UPDATE users SET numberVerify= 1 WHERE id= '$user_id'";
    $results = mysqli_query($db, $query);
    unset($_SESSION['numberCode']);
}

}

?>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>Verify</title>
  </head>
  <body>
    <?php  if (isset($_SESSION['email'])) : ?>
      <p>Welcome <strong><?php echo $_SESSION['email']; ?></strong></p>

    <?php endif ?>
     <a href="welcome.php?logout='1'" style="color: red;">logout</a>
    <p>Your Mail: <?php echo $user['email'] ?> </p>
    <p>Your Mail: <?php echo $user['phoneNumber'] ?> </p>
    <!-- notification message -->
    <?php if ($user['emailVerify'] == 1) : ?>
    <ul style="color:green">
      <li>This email is verified!</li>
    </ul>
    <?php endif ?>   
    <?php if ($user['numberVerify'] == 1) : ?>
    <ul style="color:green">
      <li>This number is verified!</li>
    </ul>
    <?php endif ?>
    <?php if ($user['numberVerify'] == 1 && $user['emailVerify'] == 1){
    header('location: welcome.php');
     }
  ?>
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php 
            echo $_SESSION['success']; 
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>
    <?php if ($user['emailVerify'] != 1) : ?>
      <a href="email.php" class="btn btn-success">  Send Mail</a>
    <?php endif ?>   
   <?php if ($user['numberVerify'] != 1) : ?>
      <a href="smsVerify.php" class="btn btn-success">  Send Code</a>
    <?php endif ?>
    <?php if (isset($_SESSION['codeSend'])) : ?>
      <div>
        <h3>
          <form class="from-group" method="post">
            <input type="text" name="code" class="from-control" placeholder="Enter your code(email)...">
            <button type="submit" name="email_code" class="btn btn-success">Submit</button>
          </form>
        </h3>
      </div>
    <?php endif ?>    

    <?php if (isset($_SESSION['numberCode'])) : ?>
      <div>
        <h3>
          <form class="from-group" method="post">
            <input type="text" name="code" class="from-control" placeholder="Enter your code(number)...">
            <button type="submit" name="number_code" class="btn btn-success">Submit</button>
          </form>
        </h3>
      </div>
    <?php endif ?>    


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
</html>
