<?php
class Db {
  
  public function connect() {
    static $connection;
    if(!isset($connection)){
    $config = parse_ini_file('config.ini');
    $connection = mysqli_connect('localhost', $config['username'], $config['password'], $config['dbname']);
    }
    if($connection === false){
      echo("Could not connect to the database");
      return mysqli_connect_error();
    }else{
      // echo("You are connected to the database");
      return $connection;
    }
 
  }

  public function select($query){
    
    $connection = $this -> connect();
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['username'];
    
  }

}

?>