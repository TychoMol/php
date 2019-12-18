<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/login.css">
    <script src="script.js"></script>
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
        Uw profiel
    </h1>
    <?php
    if (isset($_GET["error"]))
        if ($_GET["error"] == "emptyfields") {
            echo '<p class="signupError">U heeft één of meerdere velden open gelaten!</p>';
        }
        elseif ($_GET["error"] == "invalidmail"){
            echo '<p class="signupError">Er is een ongeldig emailadres ingevoerd!</p>';
        }
        elseif ($_GET["error"] == "onjuistenaam"){
            echo '<p class="signupError">Een naam kan alleen letters bevatten!<p>';
        }
        elseif ($_GET["error"] == "passwordcheck"){
            echo '<p class="signupError">De wachtwoorden komen niet overeen!';
        }
    if (isset($_SESSION['userID'])){
        echo '<p>Vul hieronder uw gegevens in om deze bij te werken.</p>';
        echo '<form class="inputBoxes" action="includes/update.inc.php" method="post">';
        echo '<input type="text" name="vnaam" placeholder="Voornaam">';
        echo ' <input type="text" name="anaam" placeholder="Achternaam">';
        echo '<input type="text" name="email" placeholder="Email">';
        echo '<input type="password" name="passw" placeholder="Wachtwoord">';
        echo '<input type="password" name="passw-repeat" placeholder="Wachtwoord herhalen">';
        echo '<button type="submit" name="update-info">Account Bijwerken</button>';
        echo '</form>';
        echo '<br>';
        echo '<form class="inputBoxes" action="includes/delete.inc.php" method="post">';
        echo '<button type="submit" name="acdelete" onclick="acdelete()">Account Verwijderen</button>';
        echo '</form>';
        }
    else {
        echo '<p>Maak eerst een account aan voordat u deze pagina bezoekt. Dit kan door <a href="createAcc.php">HIER</a> te klikken</p>';
        echo '<p>Heeft u al een account? Log dan in door <a href="login.php">HIER</a> te klikken!</p>';
    }
    ?>
</div>
</body>
</html>

