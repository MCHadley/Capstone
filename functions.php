<?php
function dbConnect(){
 
  static $connection;
  if(!isset($connection)){
  $config = parse_ini_file('config.ini');
  $connection = mysqli_connect('localhost', $config['username'], $config['password'], $config['dbname']);
 }

 if($connection === false){
  echo ("Could not connect to the specified database");
  return mysqli_connect_error();
  }else{
  echo ("You are connected to the database");
    }
}

function dbQuery($query){
  $connection = dbConnect();
  $result = mysqli_query($connection, $query);

  return $result;
}

?>
