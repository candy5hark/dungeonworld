<?php


function new_room($conn, $description, $coordX, $coordY)
{

    $sql = "INSERT INTO rooms (description, coordX, coordY)
    VALUES (".  .", " . $coordX .", ". $coordY .")";

    if ($conn->query($sql) === TRUE) {
    echo "New record created successfully\n";
    } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }


}





 ?>
