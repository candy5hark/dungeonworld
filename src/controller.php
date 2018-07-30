<?php


function connect(){
  $servername = "localhost";
  $username = "root";
  $password = "rootpassword";
  $dbname = "world_explore";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  return $conn;

}

function getRoomInfo($coordX, $coordY){

  $conn = connect();

  $sql = "Select description from rooms where coordX = ".$coordX." and coordY = ".$coordY;

  $result = $conn->query($sql);


  $conn->close();

  return $result->fetch_assoc()["description"];


}



 ?>
