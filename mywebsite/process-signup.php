<?php
//If name element is empty, output name is required and don't continue the script.
if (empty($_POST["name"])) {
    die("Name is required");
}
//If email isn't valid, output valid email is required.
if ( ! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}
//If password is less than 8 characters, output password must be at least 8 characters
if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}
//If password doesn't contain a letter, output password must contain at least one letter.
if ( ! preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}
//If password doesn't contain a number, output password must contain at least one number.
if ( ! preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}
//If passwords dont match, output passwords must match
if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}
//This stores the password as a hash so that hackers can't see passwords if they gain access to the database.
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$mysqli = require __DIR__ . "/database.php";
//Inserts these details into the database.
$sql = "INSERT INTO user (name, email, password_hash)
        VALUES (?, ?, ?)";
        
$stmt = $mysqli->stmt_init();

if ( ! $stmt->prepare($sql)) {
    die("SQL error: " . $mysqli->error);
}

$stmt->bind_param("sss",
                  $_POST["name"],
                  $_POST["email"],
                  $password_hash);
 //If the sign up is successful, go to the signup success page.                 
if ($stmt->execute()) {

    header("Location: signup-success.html");
    exit;
    
} else {
  //If email is already in use, output email already taken.  
    if ($mysqli->errno === 1062) {
        die("email already taken");
    } else {
        die($mysqli->error . " " . $mysqli->errno);
    }
}