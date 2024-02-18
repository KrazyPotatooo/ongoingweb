<?php
    session_start();
    if (!isset($_SESSION['login_user'])) {
        header("Location: index.php");
    }

    if(isset($_POST['logout'])) {
        session_destroy();
        header("location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Home</title>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">

        <div class="right-links">
            <a href="register.php"> <button class="btn btn-primary btn-sm">Sign Up</button> </a>
            <a href="logout.php"> <button class="btn btn-primary btn-sm">Log Out</button> </a>
        </div>
    </nav>
</header>
    <section id="home">
        
        <section>
            <h1>WELCOME, Guest</h1>
        </section>
        
    </section>

</body>
</html>