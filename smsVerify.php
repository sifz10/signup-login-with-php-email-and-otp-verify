<?php 
require 'vendor/autoload.php';
require 'session.php';
require 'database.php';
$rand = rand(999999 , 100000);

$basic  = new \Nexmo\Client\Credentials\Basic('de72066f', 'LttJnhM3fiFK6pj9');
$client = new \Nexmo\Client($basic);

$message = $client->message()->send([
    'to' => '8801789838721',
    'from' => 'Dream Media',
    'text' => 'Your varification code is: '.$rand,
]);
  $_SESSION['numberCode'] = 1;
  $_SESSION['success'] = "Code has been sent to your Number";

  $user_id = $user['id'];
  $query = "UPDATE users SET numberVerify = $rand WHERE id = '$user_id'";
  $results = mysqli_query($db, $query);
  header('location: verify.php');
?>