<?php
// Includes
include('includes/header.php');
include('includes/navbar.php');
if(!$_SESSION['loggedin']){
  echo "<p>Please login or create an account to view your booklist</p>";
}else{
  include('booklist.php');
}
include('includes/footer.php');

?>