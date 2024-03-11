<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Website with Login</title>
        <link rel="stylesheet" href="style.css" />
        <!--Unicons-->
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    </head>
    <body>
        <!-- Header -->
        <header class="header">
            <nav class="nav">
                <a href="#"><img class="img_q" src="images/logo.png"></a>

                <ul class="nav items">
                    <li class="nav_item">
                        <a href="index.php" class="nav_link">Home</a>
                        <a href="about.php" class="nav_link">About Me</a>
                        <a href="projects.php" class="nav_link">Projects</a>
                        <a href="contact.html" class="nav_link">Contact</a>
                    </li>
                </ul>
                <?php if (isset($user)): ?>
        <!--Outputs hello and the users name-->
        <p class="h3">Hello <span><?= htmlspecialchars($user["name"]) ?></span></p>
      <!--Logout link-->  
        <p style="margin-left: 30px;"><a href="logout.php">Logout</a></p>
        
    <?php else: ?>
        <p class="h3" style="white-space: nowrap;"><a href="login.php">Log in</a>&nbsp;or&nbsp;<a href="signup.html">sign up</a></p>
    <?php endif; ?>
            </nav>
        </header>
</html>