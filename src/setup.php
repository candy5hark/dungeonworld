<?php
$servername = "localhost";
$username = "root";
$password = "rootpassword";
$dbname = "world_explore";


function createDatabase($servername, $username, $password, $dbname){


  $conn = new mysqli($servername, $username, $password);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  // Create database
  $sql = "CREATE DATABASE ".$dbname;
  if ($conn->query($sql) === TRUE) {
      echo "Database created successfully\n";
  } else {
      echo "Error creating database: " . $conn->error;
  }

  $conn->close();





}

function addTables($servername, $username, $password, $dbname){

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }

  // sql to create table
  $sql = "CREATE TABLE rooms(
    room_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    description TEXT,
    coordX INT(11),
    coordY INT(11)
    )";

  if ($conn->query($sql) === TRUE) {
      echo "Table MyGuests created successfully\n";
  } else {
      echo "Error creating table: " . $conn->error;
  }

  $sql = "CREATE TABLE items(
    item_id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name TEXT,
    description TEXT,
    room_id INT(11) UNSIGNED,
    FOREIGN KEY (room_id) REFERENCES rooms(room_id)
  )";

    if ($conn->query($sql) === TRUE) {
        echo "Table MyGuests created successfully\n";
    } else {
        echo "Error creating table: " . $conn->error;
    }


  $conn->close();

}

function populate($servername, $username, $password, $dbname){

  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }




    $sql = "INSERT INTO rooms (description, coordX, coordY)
    VALUES ('A dank, dark room with four exits.', 0, 0)";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully\n";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "SELECT room_id FROM rooms";
    $result = $conn->query($sql);


    //var_dump($result->fetch_assoc());
    $roomid = $result->fetch_assoc()["room_id"];
    var_dump($roomid);

    $sql = "INSERT INTO items (name, description, room_id) VALUES ('A candle', 'Flickering dimly'," .$roomid. " )";
    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully\n";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "INSERT INTO items (name, description, room_id) VALUES ('A key', 'A little bit rusted,', " .$roomid. " )";
    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully\n";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "INSERT INTO items (name, description, room_id) VALUES ('A note', 'It reads: Beware the Dark'," .$roomid. " )";
    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully\n";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "INSERT INTO rooms (description, coordX, coordY)
    VALUES ('A drippy, mossy room with blue-green foliage.', 1, 0)";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully\n";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "INSERT INTO rooms (description, coordX, coordY)
    VALUES ('A room with a purple haze near the ground.', 0, 1)";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully\n";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "INSERT INTO rooms (description, coordX, coordY)
    VALUES ('A room with a barred off window, light filtering though.', 0, -1)";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully\n";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "INSERT INTO rooms (description, coordX, coordY)
    VALUES ('A room with a table that has many knife marks.', -1, 0)";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully\n";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

}




createDatabase($servername, $username, $password, $dbname);
addTables($servername, $username, $password, $dbname);
populate($servername, $username, $password, $dbname);


?>
