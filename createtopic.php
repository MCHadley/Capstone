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

$topicSubSan = $db->clean($_POST['topicSub']);

$stmt = $connect->prepare('INSERT INTO topics(topic_subject, topic_cat, topic_by) VALUES(?,?,?)');
$stmt->bind_param('ssi', $topicSubSan, $catDesSan, $id);
$stmt->execute();
?>