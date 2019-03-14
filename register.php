<?php
include('dbClass.php');
// New database connection
$db = new Db();
// Errors array
$errors = array();

// user variables
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$userName = $_POST['userName'];
$email = $_POST['email'];
$pass = $_POST['password'];

if(isset($_POST['regSubmit'])){
  // accept input and sanitize
  $firstSan = $db->clean($firstName);
  $lastSan = $db->clean($lastName);
  $userSan = $db->clean($userName);
  $emailsSan = $db->clean($email);
    // input errors
  if(empty($firstName)){array_push($errors, "First Name is required");}
  if(empty($lastName)){array_push($errors, "Last Name is required");}
  if(empty($userName)){array_push($errors, "Username is required");}
  if(empty($email)){array_push($errors, "Email is required");}
  if(empty($pass)){array_push($errors, "Password is required");}

  echo implode('<br>', $errors);
  // Check if user exists (queries to pull user)
  $userCheck = "SELECT * FROM users WHERE username ='".$userSan."' OR email = '".$emailsSan."'";
  $userResult = $db->select($userCheck);

  // statements to check if user/email exists
  if($userResult){
    if($userResult['username'] === $userSan){
      array_push($errors, 'That username already exists');
    }
    if($userResult['email'] === $emailsSan){
      array_push($errors, 'That email already exists');
    }
    echo implode('<br>', $errors);
  }
  // hash password
  $options = ['cost' => 12, 'salt'];
  $passSecure = password_hash($pass, PASSWORD_BCRYPT, $options);

  // Register user if no errors
  if(count($errors) == 0) {
    // insert data
  $queryIn = "INSERT INTO users(username, password, firstName, lastName, email)";
  $queryVa = "VALUES('".$userSan."','".$passSecure."','".$firstSan."','".$lastSan."','".$emailsSan."')";
  $queryFinal = $queryIn.$queryVa;
  $message = "You have successfully registered";
  $db->insert($queryFinal, $message);
  }
}
?>