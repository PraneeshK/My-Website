<?php

$is_invalid = false;
//Checks if form has been submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
 
    //Checks if details are in the database.
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM user
                    WHERE email = '%s'",
                    //Stops sql injections
                   $mysqli->real_escape_string($_POST["email"]));
    //execute sql
    $result = $mysqli->query($sql);
    //Gets data from result object
    $user = $result->fetch_assoc();
    
    if ($user) {
        //checks if encrypted password matches normal one.
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            //Regenerates session Id to reduce risk of attacks
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: index.php");
            exit;
        }
    }
    //Shows that either email or password is invalid
    $is_invalid = true;
}

?>
<!DOCTYPE html>
<html>
<head>

    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>
    
    <h1>Login</h1>
    <!--If email or password is wrong output invalid login. Not more specific in case of attackers
    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
    <!--Email Field -->
    <form method="post">
        <!--Value function saves email in box if incorrect details are inputted -->
        <label for="email">email</label>
        <input type="email" name="email" id="email"
            value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
            <!--Password Field -->
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <!--Login button -->
        <button>Log in</button>
    </form>
    
</body>
</html>