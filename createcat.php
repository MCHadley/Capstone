<?php
include('includes/header.php');
include('includes/navbar.php');
include('includes/footer.php');
include('includes/dbClass.php');
session_start();
$id = $_SESSION['id'];
$user = $_SESSION['name'];
$db = new Db();
$connect = $db->connect();


if($_SESSION['loggedin'] == FALSE){
  echo ('<p>Please create an account to add a category</p>');
}else{
  echo ('<div class="catContainer">
        <form method="POST" action="">
        <label for="catName">Category Name</label>
        <input type="text" name="catName" id="catName"><br>
        <label for="catDes">Category Description</label>
        <textarea name="catDes" name="catDes" id="catDes"></textarea>
        <input type="submit" value="Add Category">
        </form>
      </div>
');
  $catNameSan = $db->clean($_POST['catName']);
  $catDesSan = $db->clean($_POST['catDes']);

  $stmt = $connect->prepare('INSERT INTO categories(cat_name, cat_description) VALUES(?,?)');
  $stmt->bind_param('ss', $catNameSan, $catDesSan);
  $stmt->execute();
}

?>