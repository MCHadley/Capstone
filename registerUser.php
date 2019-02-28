<?php
include('dbClass.php');
$db = new Db();
$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$userName = $_POST['userName'];
$email = $_POST['email'];
$pass = $_POST['password'];

$firstSan = $db->clean($firstName);
$lastSan = $db->clean($lastName);
$userSan = $db->clean($userName);
$emailsSan = $db->clean($email);
$passSan = $db->clean($pass);


$queryIn = "INSERT INTO users(username, password, firstName, lastName, email)";
$queryVa = "VALUES('".$userSan."','".$passSan."','".$firstSan."','".$lastSan."','".$emailsSan."')";
$queryFinal = $queryIn.$queryVa;
$db->insert($queryFinal);



?>