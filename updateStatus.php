<?php
// Start session and grab user id
session_start();
$id = $_SESSION['id'];
// Include database class
include('includes/dbClass.php');
// create new db instance
$db = new Db();
// create db connection
$conn = $db->connect();

$stmt->prepare('UPDATE status SET stat = ? WHERE user_id = ? AND book_id = ?');

?>