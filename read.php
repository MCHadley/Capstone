<?php
//database class
include('includes/dbClass.php');
//Start session and grab variables
session_start();
$id = $_SESSION['id'];
$user = $_SESSION['name'];
// database connection
$db = new Db();
// create connect var for prepared stmts
$connect = $db->connect();
// prepared statments for pulling users read list
$stmt = $connect->prepare(
'SELECT books.title, authors.authorFirst, authors.authorLast, books.description, status.status, books.dateAdded, books.dateRead 
from books INNER JOIN status on status.book_id = books.book_id 
INNER JOIN authors on authors.author_id = books.author 
WHERE status.user_id = ? AND status.status = 1;');
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($title, $authorFirst, $authorLast, $description, $status, $dateAdded, $dateRead);
//Create and print table with booklist
echo('<table><tr>
      <th>Title</th>
      <th>Author</th>
      <th>Date Read</th>
      </tr>');
while($stmt->fetch()){
  //Concat author name
  $authorName = $authorFirst." ".$authorLast;
  printf("<tr>
            <td>%s</td>
            <td>%s</td>
            <td>%s</td>
          </tr>", $title, $authorName, $dateRead);
}
echo('</table>')

?>