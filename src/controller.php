<?php

class RoomObject{
  public $description;
  public $id;
  public $coordX;
  public $coordY;
}

class ItemObject{
  public $name;
  public $description;
}


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

  $sql = "Select * from rooms where coordX = ".$coordX." and coordY = ".$coordY;

  $result = $conn->query($sql);

  $aRoom = new RoomObject();

  //echo var_dump($result->fetch_assoc());

  $row = $result->fetch_assoc();

  $aRoom->description = $row["description"];
  $aRoom->id = $row["room_id"];
  $aRoom->coordX = $row["coordX"];
  $aRoom->coordY = $row["coordY"];


  $conn->close();

  return $aRoom;


}

function getItems($roomId){
  $conn = connect();

  $sql = "Select * from items where room_id = ".$roomId;

  $result = $conn->query($sql);

  $itemsList = array();

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      $item = new ItemObject();
      $item->name = $row["name"];
      $item->description = $row["description"];
      array_push($itemsList, $item);
     }
   }

   return $itemsList;

}

function placeItem($coordX, $coordY, $itemName, $itemDesc){
  $conn = connect();

  $itemName = mysqli_real_escape_string($conn, $itemName);
  $itemDesc = mysqli_real_escape_string($conn, $itemDesc);

  $sql = "SELECT room_id FROM rooms WHERE coordX = ".$coordX. "  and coordY = ".$coordY;
  $result = $conn->query($sql);


  $roomid = $result->fetch_assoc()["room_id"];

  $sql = "INSERT INTO items (name, description, room_id) VALUES ('".$itemName."', '".$itemDesc."', " .$roomid. " )";

  if ($conn->query($sql) === TRUE) {
  echo "New record created successfully\n";
  } else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  }

}

function checkIfRoomExists($coordX, $coordY){
  $conn = connect();

  $sql = "Select * from rooms where coordX = ".$coordX." and coordY = ".$coordY;
  $result = $conn->query($sql);
  if (!$result->num_rows) {
    //echo false;
    return false;
  }
  else{
    //echo true;
    return true;
  }
}

function createRoom($coordX, $coordY, $desc){
  $conn = connect();


  $sql = "Select * from rooms where coordX = ".$coordX." and coordY = ".$coordY;
  $result = $conn->query($sql);
  if (!$result->num_rows) {

    $desc = mysqli_real_escape_string($conn, $desc);
    $sql = "INSERT INTO rooms (description, coordX, coordY)
    VALUES ('".$desc."', ".$coordX.", ".$coordY.")";
    if ($conn->query($sql) === TRUE) {
    echo "New room created!\n";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;

    }
  }
  else{
    echo "Oops! Someone made it before you.";
  }



}


 ?>
