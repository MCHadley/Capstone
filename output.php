<?php
include('includes/header.php');
include('includes/navbar.php');
include('includes/dbClass.php');
$db = new Db();
$conn = $db -> connect();
$userID = $_SESSION['id'];

$formElements = $_POST;
$bookID = $formElements['id'];
$status = $formElements['status'];

$arrays = array_combine($bookID, $status);
foreach($arrays as $id => $stat){
 $query = 'INSERT INTO status(user_id, book_id, stat) VALUES('.$userID.', '.$id.', '.$stat.')';
  if($conn->query($query) === TRUE){
    header('Location: bookshelf.php');
  }else{
    echo "Error: Your books have not been added <br>" . $conn->error;
  }
}
?>