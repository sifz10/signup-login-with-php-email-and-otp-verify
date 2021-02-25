<?php 

require 'session.php';

// echo $user['fname'];

    if ($user['emailVerify'] == 0) {
      header('location: verify.php');
    }  
    if ($user['numberVerify'] == 0) {
      header('location: verify.php');
    }

?>

<div class="header">
  <h2>Wellcome </h2>
  <a href="welcome.php?logout='1'" style="color: red;">logout</a>
</div>
<div class="content">
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
    <!-- notification message -->
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

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['email'])) : ?>
      <p>Welcome <strong><?php echo $_SESSION['email']; ?></strong></p>
      <p>  </p>
    <?php endif ?>
</div>