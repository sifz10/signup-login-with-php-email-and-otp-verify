<?php
 include_once 'database.php';

session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 


// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $fname = $_POST['fname'];
  $lname = mysqli_real_escape_string($db, $_POST['lname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $countryCode = mysqli_real_escape_string($db, $_POST['countryCode']);
  $phoneNumber = mysqli_real_escape_string($db, $_POST['phoneNumber']);
  $dob = mysqli_real_escape_string($db, $_POST['dob']);
  $terms = mysqli_real_escape_string($db, $_POST['terms']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($fname)) { 
    array_push($errors, "First name is required");
    header("location: signup.php?error=First name is required"); 
}
  if (empty($lname)) { 
    array_push($errors, "Last name is required");
    header("location: signup.php?error=Last name is required"); 
}
  if (empty($password)) { 
    array_push($errors, "Password is required"); 
    header("location: signup.php?error=Password is required");
}
  if (empty($countryCode)) { 
    array_push($errors, "Country Code is required");
    header("location: signup.php?error=Country Code is required");
}
  if (empty($phoneNumber)) { 
    array_push($errors, "Phone number is required"); 
    header("location: signup.php?error=Phone Number is required");
}
  if (empty($dob)) { 
    array_push($errors, "Date of birth is required"); 
    header("location: signup.php?error=Date of birth is required");
}
  if (empty($email)) { 
    array_push($errors, "Email is required"); 
    header("location: signup.php?error=Email is required");
}
  if (empty($password)) { 
    array_push($errors, "Password is required"); 
    header("location: signup.php?error=Password is required");
} 
 if (empty($terms)) { 
    array_push($errors, "terms is required"); 
    header("location: signup.php?error=terms is required");
}

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
      header("location: signup.php?error=Email already exists");
    }
  }

 if (time() < strtotime('+18 years', strtotime($dob))) {
    array_push($errors, "Age is under 18"); 
    header("location: signup.php?error=Age is not 18");
} 
// echo $number = $countryCode.$phoneNumber;
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    // $passwordHash = md5($password);//encrypt the password before saving in the database
    $query = "INSERT INTO users (fname, lname, email, phoneNumber, dob, terms, password) 
    VALUES ('$fname','$lname','$email','$phoneNumber','$dob','$terms','$password')";
    mysqli_query($db, $query);

    $_SESSION['email'] = $email;
    $_SESSION['success'] = "You are now logged in";
    header('location: welcome.php');
  }
}

// ... 

?>

