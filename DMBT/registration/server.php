<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$mobile   = "";
$id = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost:3308', 'root', '', 'registration');
//$query = "SELECT * FROM users WHERE id='$id'";

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
  $Password_1 = mysqli_real_escape_string($db, md5($_POST['Password_1']));
  $Password_2 = mysqli_real_escape_string($db, md5($_POST['Password_2']));

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($mobile)) { array_push($errors, "Mobile no is required"); }
  if (empty($Password_1)) { array_push($errors, "Password is required"); }
  if (empty($Password_2)) { array_push($errors, " Confirm Password is required"); }
  if ($Password_1 != $Password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' OR mobile='$mobile'LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }

    if ($user['mobile'] === $mobile) {
        array_push($errors, "Mobile Number already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	//$password = md5($password);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, mobile, Passcode, Confirmpasscode) 
  			  VALUES('$username', '$email', '$mobile', '$Password_1', '$Password_2')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
    $_SESSION['id'] = $id;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: login.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND Passcode='$password'";
        $results = mysqli_query($db, $query);
          if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['id'] = $id;
          $_SESSION['success'] = "You are now logged in";
          header('location: ../main page/navbar.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }
  
  ?>