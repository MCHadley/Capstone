<?php
// Includes
include('includes/header.php');
include('includes/navbar.php');
?>
<div class="body-container">
<?php
include('search.php');
if(!$_SESSION['loggedin']){
  echo "<p>Please login or create an account to view your booklist</p>";
}else{
  include('booklist.php');
}
?>
</div>
<? include('includes/footer.php'); ?>