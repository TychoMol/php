<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/contact.css">
    <title>Talpa</title>
</head>
<body>
    <nav>
        <ul>
            <li><a href="#">Coaching</a></li>
            <li><a href="#">Therapie</a></li>
            <li><a href="#">Natuurlijk Gezond</a></li>
            <li><a href="#">Gedichten Bundel</a></li>
            <li class="talpa"><a href="#">Talpa</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Over Mij</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="index.php">Reserveren</a>
                <ul>
                    <?php
                    //als de session aan staat zie je profiel, anders inloggen en registreren.
                    if (isset($_SESSION['userID'])){
                        echo '<li><a href="profile.php">Mijn Profiel</a></li>';
                    }
                    else {
                        echo '<li><a href="login.php">Inloggen</a></li>';
                        echo '<li><a href="createAcc.php">Registreren</a></li>';
                    }
                    ?>
                </ul>
            </li>
        </ul>
    </nav>
    <div class="whiteOverlay">
        <h1>Contact</h1>
        <p></p>
        </p>
    </div>
</body>>