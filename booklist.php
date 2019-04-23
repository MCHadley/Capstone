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
// prepared statments for pulling users book list
$stmt = $connect->prepare(
'SELECT books.book_id ,books.title, authors.authorFirst, authors.authorLast, books.description, status.stat, status.dateAdded, status.dateFinished 
from books INNER JOIN status on status.book_id = books.book_id 
INNER JOIN authors on authors.author_id = books.author 
WHERE status.user_id = ?;');
$stmt->bind_param('i', $id);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($bookId, $title, $authorFirst, $authorLast, $description, $status, $dateAdded, $dateRead);
?>

<div class="body-three">
  <div id="bookLink">
    <a href="#">Add a Book</a>
  </div>
  <div id="addBook">
    <form action="addBook.php" method="POST">
      <label for="title" hidden>Title</label>
      <input type="text" id="title" name="title" placeholder="Title"><br>
      <label for="authorFirst" hidden>Author First Name</label>
      <input type="text" id="authorFirst" name="authorFirst" placeholder="Author First Name"><br>
      <label for="authorLast" hidden>Author Last Name</label>
      <input type="text" id="authorLast" name="authorLast" placeholder="Author Last Name"><br>
      <label for="ISBN" hidden>ISBN</label>
      <input type="text" id="isbn" name="isbn" placeholder="ISBN"><br>
      <label for="read">Read</label><input type="radio" name="status" value="1"><br>
      <label for="reading">Reading</label><input type="radio" name="status" value="2"><br>
      <label for="toread">To-Read</label><input type="radio" name="status" value="3"><br>
      <input type="submit" id="submit" name="submit" value="Add Book">
    </form>
  </div>
<?
//Create and print table with booklist
echo('<div class="sort"><a href="#" class="allbooks">All Books</a>
      <a href="#" class="read">Read</a>
      <a href="#" class="reading">Reading</a>
      <a href="#" class="toread">To-Read</a></div>');
echo('<table><tr>
      <th>Title</th>
      <th>Author</th>
      <th>Shelf</th>
      <th>Date Added</th>
      <th>Date Read</th>
      </tr>');
while($stmt->fetch()){
  //Concat author name
  $authorName = $authorFirst." ".$authorLast; 
  // Change status into shelf name
  if($status == 1){
    $shelf = 'Read';
  }elseif($status == 2){
    $shelf = 'Currently Reading';
  }elseif($status == 3){
    $shelf = 'To-Read';
  }
  printf("
            <tr>
              <td>%s</td>
              <td>%s</td>
              <td class='shelf'>%s</td>
              <td>%s</td>
              <td>%s</td>
              <td hidden class='bookId'>%s</td>
            </tr>
          ", 
           $title, $authorName, $shelf, $dateAdded, $dateRead, $bookId);
}
echo('</table></div>');
?>