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

$status = $_POST['status'];
$bookId = $_POST['bookId'];

if($status == 1){
  $query1 = 'UPDATE status SET stat = '.$status.', dateFinished = CURDATE() WHERE user_id = '.$id.' AND book_id ='.$bookId;
  $conn->query($query1);
}else{
  $query = 'UPDATE status SET stat = '.$status.' WHERE user_id = '.$id.' AND book_id ='.$bookId;
  $conn->query($query);
}


?>