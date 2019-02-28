<?php
include('dbClass.php');
// New database connection
$db = new Db();

// user variables
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$userName = $_POST['userName'];
$email = $_POST['email'];
$pass = $_POST['password'];

// hash password
$options = ['cost' => 12, 'salt' => 'doorsofdurinmellonfriend'];
$passSecure = password_hash($pass, PASSWORD_BCRYPT, $options);

// sanitize data
$firstSan = $db->clean($firstName);
$lastSan = $db->clean($lastName);
$userSan = $db->clean($userName);
$emailsSan = $db->clean($email);

// insert data
$queryIn = "INSERT INTO users(username, password, firstName, lastName, email)";
$queryVa = "VALUES('".$userSan."','".$passSecure."','".$firstSan."','".$lastSan."','".$emailsSan."')";
$queryFinal = $queryIn.$queryVa;
$db->insert($queryFinal);

?>