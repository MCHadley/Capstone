<?php
//database class
include('dbClass.php');
include('header.php');
include('navbar.php');
include('footer.php');
//Start session and grab variables
session_start();
$id = $_SESSION['id'];
$user = $_SESSION['name'];
// database connection
$db = new Db();
// create connect var for prepared stmts
$connect = $db->connect();
// prepared statments for pulling users book list
$stmt = $connect->prepare(
'SELECT books.title, authors.authorFirst, authors.authorLast, books.description, status.status, books.dateAdded, books.dateRead 
from books INNER JOIN status on status.book_id = books.book_id 
INNER JOIN authors on authors.author_id = books.author 
WHERE status.user_id = ?;');
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($title, $authorFirst, $authorLast, $description, $status, $dateAdded, $dateRead);
while($stmt->fetch()){
  printf("<p>%s (%s)</p>\n", $title, $authorFirst." ".$authorLast);
}

?>