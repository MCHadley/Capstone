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
// Create new database and connect
$db = new Db();
$connect = $db->connect();

$stmt = $connect->prepare('SELECT cat_id, cat_name FROM categories');
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($catID, $catName);
$stmt->fetch();
// echo $catID;
// echo $catName;

echo('<div class="topicContainer">
  <form method="POST" action="createtopic.php">
  <label for="topSub">Topic Subject</label>
  <input type="text" name="catName" id="catName"><br>
  <label for="topCat">Topic Category</label>
  <select name="topCat">
    <options value'.$catID.'>'.$catName.'</options>
  </select>
  <label for="topMsg">Message</label>
  <textarea name="topMsg" id="topMsg"></textarea>
  <input type="submit" value="Add Category">
  </form>
  </div>');
// while($stmt->fetch()){
  
// }

// if($_SESSION['loggedin'] == FALSE){
//   echo ('<p>Please create an account to create a topic</p>');
// }else{
//   echo('<div class="topicContainer">
//   <form method="POST" action="createtopic.php">
//   <label for="topSub">Topic Subject</label>
//   <input type="text" name="catName" id="catName"><br>
//   <label for="topCat">Topic Category</label>
//   <select name="topCat">
//     <options value'.$catID.'>'.$catName.'</options>
//   </select>
//   <label for="topMsg">Message</label>
//   <textarea name="topMsg" id="topMsg"></textarea>
//   <input type="submit" value="Add Category">
//   </form>
//   </div>');
// }

?>