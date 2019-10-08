<?php
session_start();
// connect to the database
require_once 'connection.php';
// initializing variables
// $username = "";
$email    = "";
$firstname = "";
$lastname    = "";
$hospital    = isset($_SESSION['hospital']) ? $_SESSION['hospital'] : '';
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
	$patientRedirectUrl = str_replace( [' ', '\"', '\''], "-", strtolower($hospital) ) .'/patientorexisting.php';
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (firstname, lastname, email, password, hospital)
  			  VALUES('$firstname', '$lastname', '$email', '$password', '$hospital')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $email;
	$_SESSION['hospital'] = $hospital;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: /'.$patientRedirectUrl);
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
  	$query = "SELECT * FROM users WHERE email=? AND password=?";
    $results  =  $pdo->getResult($query, [$email, $password]);
  	if ($results) {
  	  $_SESSION['username'] = $email;
  	  $_SESSION['hospital'] = $results[0]['Hospital'];
  	  $_SESSION['success'] = "You are now logged in";
	  $patientRedirectUrl = str_replace( [' ', '\"', '\''], "-", strtolower($_SESSION['hospital']) ) .'/patientorexisting.php';
  	  header('location: /'.$patientRedirectUrl);
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
    VALUES(?,?,?,?)";
    $patientId   = $pdo->insert($query, [$firstname, $lastname, $medicalrecord, $hospital]);
  	$_SESSION['medicalrecord'] = $medicalrecord;
    $_SESSION['hopsital'] = $hospital;
    $_SESSION['patient_name'] = $firstname.' '.$lastname;
  	$_SESSION['success'] = "Patient Created";
	$patientRedirectUrl = str_replace( [' ', '\"', '\''], "-", strtolower($_SESSION['hospital']) ) .'/index.php';
  	header('location: /'. $patientRedirectUrl);
  }
}



// Submit Patient Records
if (isset($_POST['reg_medialsubmission'])) {
  //pr($_POST);
  
  // $data = $_POST['data'];
  //
  // // convert json into array
  // $array = json_decode($data);
  // receive all input values from the form
  $medicalrecordInput = mysqli_real_escape_string($db, $_POST['medicalrecordinput']);
  //$submission = mysqli_real_escape_string($db, $_POST['submission']);
  $hospital = mysqli_real_escape_string($db, $_POST['hospitalinput']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($medicalrecordInput)) { array_push($errors, "Medial Record is required"); }
  //if (empty($submission)) { array_push($errors, "Submission is required"); }
  if (empty($hospital)) { array_push($errors, "Hospital is required"); }

  // a user does not already exist with the same username and/or email
  /* $medical_check_query = "SELECT medicalrecord FROM patients WHERE medicalrecord='$medicalrecord' LIMIT 1";
  $result = mysqli_query($db, $medical_check_query);
  $medical = mysqli_fetch_assoc($result); */

  $submission = ''; 
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $recordArr  = explode(',', $_POST['medicalrecordinput']);
    $args       = explode(',', $_POST['qids']);
    $ques       = $pdo->getResult('select * from questions where id IN ('. str_pad('',count($args)*2-1,'?,').')', $args);
    $score      = [];
    foreach($ques as $q){
      $key    = $q['id'];
      // scores are based on what is in db
      $score[$key]  = $q['points'];
    }

    $totalScore   = 0;
    foreach($_POST['ques'] as $key => $input){
      if(isset($score[$key])){
        $totalScore   += $score[$key];
      }
    }

    $icd_nat_score = 0;
    foreach($recordArr as $record){
      // get icd_nat_score
      $arr_icd_data = $pdo->getResult('select * from icd where icd_code = ?', Array($record));
      //print_r($arr_icd_data);
      if (count($arr_icd_data) > 0) {
        if ($arr_icd_data[0]['icd_tertiary_ranking'] > 0) {
          $icd_nat_score = $arr_icd_data[0]['icd_tertiary_ranking'];
        }
      }
      $query = "INSERT INTO patient_icd_codes (medicalrecord, icd_code)
            VALUES(?, ?)";
      $pdo->insert($query, [$_SESSION['medicalrecord'], $record]);
    }
    $totalScore += $icd_nat_score;

    foreach($ques as $q){
      $key    = $q['id'];
      $answer = 'No';
      $points   = 0;
     if(isset($_POST['ques'][$key])){
        $points   = $score[$key];
        $answer = 'Yes';
      }
      $query = "INSERT INTO patient_answers (medicalrecord, question_id, answer, points)
          VALUES(?, ?, ?, ?)";
      $pdo->insert($query, [$_SESSION['medicalrecord'], $q['id'], $answer, $points]);
    }
	
    $patientRedirectUrl = str_replace( [' ', '\"', '\''], "-", strtolower($_SESSION['hospital']) ) .'/patientorexisting.php';

    flashMsg("Patient Record Submitted successfully and score was ". $totalScore);
    unset($_SESSION['medicalrecord']);
    header('location: /'.$patientRedirectUrl);
  }
}


?>
