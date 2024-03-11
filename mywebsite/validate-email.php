<?php
//Connect to database.
$mysqli = require __DIR__ . "/database.php";
//Checks if email exists in database
$sql = sprintf("SELECT * FROM user
                WHERE email = '%s'",
                $mysqli->real_escape_string($_GET["email"]));
   //Runs code             
$result = $mysqli->query($sql);

//If number of rows is 0, email is available, or else it isnt.
$is_available = $result->num_rows === 0;

header("Content-Type: application/json");

echo json_encode(["available" => $is_available]);