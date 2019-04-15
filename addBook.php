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

$title = $_POST['title'];
$authorFirst = $_POST['authorFirst'];
$authorLast = $_POST['authorLast'];
$isbn = $_POST['isbn'];
$status = $_POST['status'];
$dateAdded = date('Y-m-d');

$titleSan = $db->clean($title);
$auFirstSan = $db->clean($authorFirst);
$auLastSan = $db->clean($authorLast);
$isbnSan = $db->clean($isbn);

$stmt = $conn->prepare('INSERT INTO authors(authorFirst, authorLast) VALUES(?,?)');
$stmt->bind_param('ss', $auFirstSan, $auLastSan);
$stmt->execute();

$stmt = $conn->prepare('SELECT author_id FROM authors WHERE authorFirst = ? AND authorLast = ?');
$stmt->bind_param('ss', $auFirstSan, $auLastSan);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($authorID);
$stmt->fetch();

$stmt = $conn->prepare('INSERT INTO books(isbn, title, author, dateAdded) VALUES(?,?,?,?)');
$stmt->bind_param('isss',$isbn, $titleSan, $authorID, $dateAdded);
$stmt->execute();

$stmt = $conn->prepare('SELECT book_id FROM books WHERE isbn = ? AND title = ?');
$stmt->bind_param('is', $isbn, $titleSan);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($bookID);
$stmt->fetch();

$stmt = $conn->prepare('INSERT INTO status(user_id, book_id, stat) VALUES(?,?,?)');
$stmt->bind_param('iii', $id, $bookID, $status);
$stmt->execute();

?>