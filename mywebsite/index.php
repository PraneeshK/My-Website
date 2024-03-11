<?php 

session_start();

if (isset($_SESSION["user_id"])) {
    //Accesses database and finds user field
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM user
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    //Gets value from user field
    $user = $result->fetch_assoc();
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css" />

</head>
<body>

<div>
<?php include ('header.php');?>
</div>
<div>
<h1>Welcome To My Website</h1>
</div>
<?php include ('footer.html');?>
</body>
</html>
    
    
    
    
    
    
    
    
    
    
    