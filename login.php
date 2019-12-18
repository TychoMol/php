<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/login.css">
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
            Inloggen
        </h1>
        <p>Vul hieronder uw gegevens in om in te loggen op de website en bijv. afspraken in te plannen.</p>
        <p>Heeft u nog geen account? Maak dan kostenloos een account door <a href="createAcc.php">HIER</a> te klikken!</p>
        <form action="includes/login.inc.php" method="post">
            <input type="text" name="email" placeholder="E-mail...">
            <input type="password" name="passw" placeholder="Wachtwoord...">
            <button type="submit" name="login-submit">Login</button>
        </form>
    </div>
</body>
</html>

