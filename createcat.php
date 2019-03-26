<?php
include('includes/dbClass.php');
session_start();
$id = $_SESSION['id'];
$user = $_SESSION['name'];
$db = new Db();
$connect = $db->connect();

$catNameSan = $db->clean($_POST['catName']);
$catDesSan = $db->clean($_POST['catDes']);

$stmt = $connect->prepare('INSERT INTO categories(cat_name, cat_description, cat_by) VALUES(?,?,?)');
$stmt->bind_param('ssi', $catNameSan, $catDesSan, $id);
$stmt->execute();
echo('Category '.$catNameSan.' has been created');
?>