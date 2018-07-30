<?php


function new_room($conn, $item_name, $description, $roomid)
{

  $sql = "INSERT INTO items (name, description, room_id) VALUES (".$item_name.", ".$description." ," .$roomid. " )";
  if ($conn->query($sql) === TRUE) {
  echo "New record created successfully\n";
  } else {
  echo "Error: " . $sql . "<br>" . $conn->error;
  }


}

 ?>
