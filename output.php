<?php
// Includes
include('includes/header.php');
include('includes/navbar.php');
include('includes/dbClass.php');
// New database instance and connection
$db = new Db();
$conn = $db -> connect();
// Get User ID
$userID = $_SESSION['id'];
// Get form 
$formElements = $_POST;
// Split into seperate arrays
$bookID = $formElements['id'];
$status = $formElements['status'];
// Recombine witk Book ID as key and Status as value
$arrays = array_combine($bookID, $status);
foreach($arrays as $id => $stat){
 $query = 'INSERT INTO status(user_id, book_id, stat) VALUES('.$userID.', '.$id.', '.$stat.')';
  if($conn->query($query) === TRUE){
    header('Location: bookshelf.php');
  }else{
    echo "<p class='message'>Error: Your books have not been added</p> <br>" . $conn->error;
  }
}
// Delete any books in status with zero
$stmt = $conn->prepare('DELETE FROM status WHERE stat = 0');
$stmt->execute();
?>