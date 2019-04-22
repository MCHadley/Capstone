<?php
// Includes for header, navbar and database
include('includes/header.php');
include('includes/navbar.php');
include('includes/dbClass.php');
// new database instance and connection
$db = new Db();
$conn = $db->connect();
// Get User ID
$id = $_SESSION['id'];
// Get data from form
$title = $_POST['title'];
$authorFirst = $_POST['authorFirst'];
$authorLast = $_POST['authorLast'];
$isbn = $_POST['isbn'];
$status = $_POST['status'];
$dateAdded = date('Y-m-d');
$dateFinished = $dateAdded;

if(isset($title, $authorFirst, $authorLast, $isbn, $status)){
  // Sanitize input
  $titleSan = $db->clean($title);
  $auFirstSan = $db->clean($authorFirst);
  $auLastSan = $db->clean($authorLast);
  $isbnSan = $db->clean($isbn);
  // Insert author
  $stmt = $conn->prepare('INSERT INTO authors(authorFirst, authorLast) VALUES(?,?)');
  $stmt->bind_param('ss', $auFirstSan, $auLastSan);
  $stmt->execute();
  // Get author ID
  $stmt = $conn->prepare('SELECT author_id FROM authors WHERE authorFirst = ? AND authorLast = ?');
  $stmt->bind_param('ss', $auFirstSan, $auLastSan);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($authorID);
  $stmt->fetch();
  // Insert book
  if($status == 1){
    $stmt = $conn->prepare('INSERT INTO books(isbn, title, author, dateAdded, dateFinished) VALUES(?,?,?,?,?)');
    $stmt->bind_param('issss',$isbn, $titleSan, $authorID, $dateAdded, $dateFinished);
    $stmt->execute();
  }else{
    $stmt = $conn->prepare('INSERT INTO books(isbn, title, author, dateAdded) VALUES(?,?,?,?)');
    $stmt->bind_param('isss',$isbn, $titleSan, $authorID, $dateAdded);
    $stmt->execute();
  }
  // Get book ID
  $stmt = $conn->prepare('SELECT book_id FROM books WHERE isbn = ? AND title = ?');
  $stmt->bind_param('is', $isbn, $titleSan);
  $stmt->execute();
  $stmt->store_result();
  $stmt->bind_result($bookID);
  $stmt->fetch();
  // Insert into status
  $stmt = $conn->prepare('INSERT INTO status(user_id, book_id, stat) VALUES(?,?,?)');
  $stmt->bind_param('iii', $id, $bookID, $status);
  $stmt->execute();
  header('Location: bookshelf.php');
}else{
  print('<h1>Please input book info to be added</h1>');
}
include('includes/footer.php');
// Re-direct to bookshelf
?>