<?php
session_start();
$id = $_SESSION['id'];

$count = 0;
$formElements = $_POST;

// foreach($formElements as $key => $val){
//   // $formElements = array();
//   // print_r($formElements['id']);
// }

var_dump($formElements['id']);
var_dump($formElements['status']);

// var_dump($_POST['id'], );




// foreach($_POST as $key => $val){
//   $count++;
//   $formElements[] = $val;
//   echo($formElements);
   
// }





// if($_POST['submit']){
//   if($_POST['book'.$count]){
//     echo($_POST['book'.$count]);
//   }
// }




?>