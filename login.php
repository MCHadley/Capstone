<?php
// Include database class and create new instance
include('dbClass.php');
$db = new Db();

//get variables from login page 
$username = $_POST['username'];
$pass = $_POST['password'];

// create login query and run query
$query = "SELECT username, password FROM users WHERE username ='".$username."'";
$result = $db -> select($query);

//If no user found error
if(!$result){
  exit('You have entered in incorrect login information, please try again');
  echo('<p><a href="login.html">Return to login page</a></p>');
}

?>