<?php
include ('dbClass.php');

$db = new Db();

$select = $db -> select("SELECT * FROM users");

if($select == 'mchadley'){
  echo("Hello Michael");
}

echo implode("," ,$select);




?>