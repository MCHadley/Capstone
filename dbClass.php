<?php
class Db {
  // Database connection func
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
  // SQL Select func
  public function select($query){
    // connect DB
    $conn = $this -> connect();
    // create query
    $result = mysqli_query($conn, $query);
    // run query result
    $row = mysqli_fetch_assoc($result);
    // return data you want
    return $row;
     
  }

  // Sanitize SQL input
  public function clean($data){
    // connect to DB
    $conn = $this->connect();
    // sanitize data
    $sanData = mysqli_real_escape_string($conn, $data);
    return $sanData;
  }

  // SQL Input func
  public function insert($statement, $message){
    // connect to DB
    $conn = $this->connect();
    // insert data
    if(mysqli_query($conn, $statement) === TRUE){
      echo ($message);
    }else{
      echo "Error: ".$statement."<br>".$conn->error;
    } 
    $conn->close();
  }

}

?>