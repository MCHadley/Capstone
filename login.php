<?php
// Include database class and create new instance
include('dbClass.php');
$db = new Db();
//Start session
session_start();
// Errors array
$errors = array();

//get variables from login page 
$username = $_POST['username'];
$pass = $_POST['password'];

if(isset($_POST['logBtn'])){
  //sanitize data
  $userSan = $db->clean($username);
  $passSan = $db->clean($pass);

  if(empty($username)){array_push($errors, "Please enter a username");}
  if(empty($pass)){array_pusy($errors, "Please enter a password");}
  echo implode("<br>", $errors);

  // create login query and run query
  $query = "SELECT username, password FROM users WHERE username ='".$userSan."'";
  $result = $db -> select($query);
  $passCheck = $result['password'];

}



//If no user found error
if(!$result){
  exit('You have entered in incorrect login information, please try again');
  echo('<p><a href="login.html">Return to login page</a></p>');
}

?>