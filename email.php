<?php 
require 'session.php';
require 'database.php';

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require_once "vendor/autoload.php";
  $rand = rand(999999, 100000);
  $mail = new PHPMailer(true);

  //Enable SMTP debugging.
  // $mail->SMTPDebug = 3;                               
  //Set PHPMailer to use SMTP.
  $mail->isSMTP();            
  //Set SMTP host name                          
  $mail->Host = "smtp.googlemail.com";
  //Set this to true if SMTP host requires authentication to send email
  $mail->SMTPAuth = true;                          
  //Provide username and password     
  $mail->Username = "dreammedia48@gmail.com";                 
  $mail->Password = "ryfmfcnubjtfkdof";                           
  //If SMTP requires TLS encryption then set it
  $mail->SMTPSecure = "ssl";                           
  //Set TCP port to connect to
  $mail->Port = 465; 

  $mail->From = "dreammedia48@gmail.com";
  $mail->FromName = "Dream Media";

  $mail->addAddress($user['email'], $user['fname']);

  $mail->Subject = "Verfication Code";
  $mail->Body = "Hi there, This is your varification code ".$rand;
  // $mail->AltBody = "This is the plain text version of the email content";

  try {
      $mail->send();
      echo "Message has been sent successfully";
      $_SESSION['codeSend'] = 1;
      $_SESSION['success'] = "Code has been sent to your email";

      $user_id = $user['id'];
      $query = "UPDATE users SET emailVerify= $rand WHERE id ='$user_id'";
      $results = mysqli_query($db, $query);
      header('location: verify.php');
  } catch (Exception $e) {
       "Mailer Error: " . $mail->ErrorInfo;
       echo "Mail is not reachable!";
  }
?>