<?php
// Includes: Header, Navbar, Footer, Database Class
include('includes/header.php');
include('includes/navbar.php');
include('includes/footer.php');
include('includes/dbClass.php');
// Start session and get ID and Username
session_start();
$id = $_SESSION['id'];
$user = $_SESSION['name'];

if($_SESSION['loggedin'] == FALSE){
  echo ('<p>Please create an account to add a category</p>');
}else{
  echo ('<div class="catContainer">
        <form method="POST" action="createcat.php">
        <label for="catName">Category Name</label>
        <input type="text" name="catName" id="catName"><br>
        <label for="catDes">Category Description</label>
        <textarea name="catDes" name="catDes" id="catDes"></textarea>
        <input type="submit" value="Add Category">
        </form>
      </div>
  ');
}

?>