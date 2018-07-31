<html>
<body>
  <link rel="stylesheet" type="text/css" href="css/style.css">


<?php
require ('src/controller.php');
$roomExists = true;
$newRoomX = 0;
$newRoomY = 0;

if($_POST){

//first if checks if coordinate is valid
  if( !is_numeric($_POST["coordinateX"]) and !is_numeric($_POST["coordinateY"])){
    $currentRoom = getRoomInfo(0, 0);
  }
  else if($_POST["submit"] == "Leave Item"){
//checks and handles new item.

    $name = trim($_POST["itemName"]);
    $desc = trim($_POST["itemDescription"]);

    if($name == "" and $desc == ""){
      echo "You can't leave it blank!";
    }
    else {
      placeItem($_POST["coordinateX"], $_POST["coordinateY"], $_POST["itemName"], $_POST["itemDescription"]);
    }

    $currentRoom = getRoomInfo($_POST["coordinateX"], $_POST["coordinateY"]);
  }
  else if($_POST["submit"] == "Create Room"){

      $desc = trim($_POST["roomDescription"]);
      if($desc == ""){
        echo "You can't leave it blank!";
        $roomExists = false;
        $newRoomX = $_POST["coordinateX"];
        $newRoomY = $_POST["coordinateY"];
      }
      else{
        createRoom($_POST["coordinateX"], $_POST["coordinateY"], $desc);
        $currentRoom = getRoomInfo($_POST["coordinateX"], $_POST["coordinateY"]);

      }

  }



  //go to next rooms
  else if($_POST["submit"] == "Go North"){
    if(checkIfRoomExists($_POST["coordinateX"], $_POST["coordinateY"]+1)){
    $currentRoom = getRoomInfo($_POST["coordinateX"], $_POST["coordinateY"]+1);
    }
    else {
      $roomExists = false;
      $newRoomX = $_POST["coordinateX"];
      $newRoomY = $_POST["coordinateY"]+1;
    }
  }
  else if ($_POST["submit"] == "Go East"){
    if(checkIfRoomExists($_POST["coordinateX"]+1, $_POST["coordinateY"])){
    $currentRoom = getRoomInfo($_POST["coordinateX"]+1, $_POST["coordinateY"]);
    }
    else {
      $roomExists = false;
      $newRoomX = $_POST["coordinateX"]+1;
      $newRoomY = $_POST["coordinateY"];
    }
  }
  else if ($_POST["submit"] == "Go South"){
    if(checkIfRoomExists($_POST["coordinateX"], $_POST["coordinateY"]-1)){
      $currentRoom = getRoomInfo($_POST["coordinateX"], $_POST["coordinateY"]-1);
    }
    else {
      $roomExists = false;
      $newRoomX = $_POST["coordinateX"];
      $newRoomY = $_POST["coordinateY"]-1;
    }

  }
  else if ($_POST["submit"] == "Go West"){
    if(checkIfRoomExists($_POST["coordinateX"]-1, $_POST["coordinateY"])){
      $currentRoom = getRoomInfo($_POST["coordinateX"]-1, $_POST["coordinateY"]);
    }
    else {
      $roomExists = false;
      $newRoomX = $_POST["coordinateX"]-1;
      $newRoomY = $_POST["coordinateY"];
    }
  }
  else {
    $currentRoom = getRoomInfo(0, 0);
  }
}
else{
  $currentRoom = getRoomInfo(0, 0);
}

  if($roomExists){
  $currentItems = getItems($currentRoom->id);

  echo '<br><h3>Room</h3><br>';

  echo $currentRoom->description . '<br>';

  echo '<br><h3>Items 🔍 in Room</h3><br>';

  foreach($currentItems as $item){
    echo $item->name . ': ' . $item->description . '<br>';
  }


  echo '<form method="post">';

  //'.$currentRoom->coordX.','.$currentRoom->coordY.'

  echo '<input hidden type="text" name="coordinateX" value='.$currentRoom->coordX.'>';
  echo '<input hidden type="text" name="coordinateY" value='.$currentRoom->coordY.'>';

  echo '<br><input type="submit" name="submit" value="Go North"><br>';
  echo '<br><input type="submit" name="submit" value="Go East">';
  echo '<input type="submit" name="submit" value="Go West"><br>';
  echo '<br><input type="submit" name="submit" value="Go South"><br>';

  echo '</form>';

  echo '<br><form method="post"><h3>Leave an item 🎁? </h3><br>';
  echo '<input hidden type="text" name="coordinateX" value='.$currentRoom->coordX.'>';
  echo '<input hidden type="text" name="coordinateY" value='.$currentRoom->coordY.'>';
  echo 'Item Name: <br> <input type="text" name="itemName"><br>';
  echo 'Item Description: <br> <textarea type="text" name="itemDescription" rows="5" cols="50"> </textarea> <br>';
  echo '<br><input type="submit" name="submit" value="Leave Item"><br>';
  echo '</form>';
}
else{
  echo '<br><h3>Empty Room</h3><br>';
  echo 'Looks like this room is empty. <br> To continue, please make a room! <br>';
  echo '<br><form method="post"><br>';
  echo '<input hidden type="text" name="coordinateX" value='.$newRoomX.'>';
  echo '<input hidden type="text" name="coordinateY" value='.$newRoomY.'>';
  echo 'Room Description: <br> <textarea type="text" name="roomDescription" rows="5" cols="50"> </textarea> <br>';
  echo '<br><input type="submit" name="submit" value="Create Room"><br>';

}

?>

</body>
</html>
