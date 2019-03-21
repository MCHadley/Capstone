<?php
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
$pass = $_POST['password'];

if(isset($_POST['logBtn'])){
  //sanitize data
  $userSan = $db->clean($username);
  $passSan = $db->clean($pass);

  if(empty($username)){array_push($errors, "Please enter a username");}
  if(empty($pass)){array_push($errors, "Please enter a password");}
  echo implode("<br>", $errors);

  // create login query and run query
  $stmt = $mysqli->prepare('SELECT id, username, password FROM users WHERE username = ? LIMIT 1');
  $stmt -> bind_param('s', $userSan);
  $stmt -> execute();
  $stmt -> store_result();
  $stmt -> bind_result($id, $usrName, $hash);
  $stmt -> fetch();

  // Check if user exists, if not error message, if so check password
  if(!$usrName){
    exit('You have entered in incorrect login information, please try again');
    echo('<p><a href="login.html">Return to login page</a></p>');
  }elseif(password_verify($passSan, $hash)){
    session_regenerate_id();
    $_SESSION['loggedin'] = TRUE;
    $_SESSION['name'] = $usrName;
    $_SESSION['id'] = $id;
    // echo 'Welcome '.$_SESSION['name'].'!';
    header('Location: index.php');
  }else{
    echo 'Incorrect Login';
  }
}

?>