<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/index.css">
    <script src="script.js"></script>
    <title>TalpaTherapie</title>
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
            <h1>
                Reserveren
            </h1>

        <p class="p1">Het is tegenwoordig mogelijk om voor therapie online een afspraak te maken bij Talpatherapie!</p>
            <?php
                if (isset($_SESSION['userID'])){
                    echo '<p class="login-status">U bent in gelogd!</p>';
                    echo '<form action="includes/logout.inc.php" method="post">';
                        echo '<button type="submit" name="logout-submit">Loguit</button>';
                    echo '</form>';
                 }
                else {
                    echo '<p class="logged-out">Hiervoor is het wel nodig om ingelogd te zijn.</p>';
                    echo '<p>Klik <a href="login.php">HIER</a> om in te loggen.</p>';
                    echo '<p>Nog geen account? Klik <a href="createAcc.php">HIER</a> om een account aan te maken.</p>';
                }
                if (isset($_SESSION['userID'])){
                    echo '<img src="./afbeeldingen/template.png" alt="">';
                }
            ?>
        </div>
    </body>
</html>
