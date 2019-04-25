<?php
include('includes/header.php');
include('includes/navbar.php');
// Include database class and create new instance
include('includes/dbClass.php');
$db = new Db();
$mysqli = $db->connect();
//Start session
session_start();
// Errors array
$errors = array();

//get variables from login page 
$username = $_POST['username'];
$pass = $_POST['passwordIn'];

if(isset($_POST['logBtn'])){
  //sanitize data
  $userSan = $db->clean($username);
  $passSan = $db->clean($pass);

  if(empty($username)){array_push($errors, "Please enter a username");}
  if(empty($pass)){array_push($errors, "Please enter a password");}
  echo implode("<br>", $errors);

  // create login query and run query
  $stmt = $mysqli->prepare('SELECT id, username, password, type FROM users WHERE username = ? LIMIT 1');
  $stmt -> bind_param('s', $userSan);
  $stmt -> execute();
  $stmt -> store_result();
  $stmt -> bind_result($id, $usrName, $hash, $level);
  $stmt -> fetch();

  // Check if user exists, if not error message, if so check password
  if(!$usrName){
    exit('<p class="message">You have entered in incorrect login information, please try again</p>');
    echo('<p><a href="login.html">Return to login page</a></p>');
  }elseif(password_verify($passSan, $hash)){
    session_regenerate_id();
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['name'] = $usrName;
    $_SESSION['id'] = $id;
    $_SESSION['level'] = $level;
    header('Location: index.php');
  }else{
    echo '<p class="message">Incorrect Login</p>';
  }
}

?>