<?php
session_start();
// connect to the database
require 'connection.php';
// initializing variables
// $username = "";
$email    = "";
$firstname = "";
$lastname    = "";
$hospital    = "";
$medicalrecord    = "";
$errors = array();




// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
  $hospital = mysqli_real_escape_string($db, $_POST['hospital']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($firstname)) { array_push($errors, "First name is required"); }
  if (empty($lastname)) { array_push($errors, "Last name is required"); }
  if (empty($hospital)) { array_push($errors, "Hospital is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  if ($user) { // if user exists

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (firstname, lastname, email, password, hospital)
  			  VALUES('$firstname', '$lastname', '$email', '$password', '$hospital')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $email;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: patientorexisting.php');
  }
}

//
// LOGIN USER
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
  	array_push($errors, "Email is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $email;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: patientorexisting.php');
  	}else {
  		array_push($errors, "Wrong email/password combination");
  	}
  }
}

// REGISTER Patient
if (isset($_POST['reg_patient'])) {
  // receive all input values from the form
  $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
  $medicalrecord = mysqli_real_escape_string($db, $_POST['medicalrecord']);
  $hospital = mysqli_real_escape_string($db, $_POST['hospital']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($firstname)) { array_push($errors, "First name is required"); }
  if (empty($lastname)) { array_push($errors, "Last name is required"); }
  if (empty($hospital)) { array_push($errors, "Hospital is required"); }
  if (empty($medicalrecord)) { array_push($errors, "Medical Record is required"); }
  // a user does not already exist with the same username and/or email
  $medical_check_query = "SELECT medicalrecord FROM patients WHERE medicalrecord='$medicalrecord' LIMIT 1";
  $result = mysqli_query($db, $medical_check_query);
  $medical = mysqli_fetch_assoc($result);

  if ($medical) { // if user exists
    if ($medical['medicalrecord'] === $medicalrecord) {
      array_push($errors, "medical record already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO patients (firstname, lastname, medicalrecord, hospital)
  			  VALUES('$firstname', '$lastname', '$medicalrecord', '$hospital')";
  	mysqli_query($db, $query);
  	$_SESSION['medicalrecord'] = $medicalrecord;
  	$_SESSION['success'] = "Patient Created";
  	header('location: index.php');
  }
}


?>
