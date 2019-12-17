<?php
 session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/createAcc.css">
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
                <li><a href="login.php">Inloggen</a></li>
                <li><a href="createAcc.php">Registreren</a></li>
                <?php
                if (isset($_SESSION['userID'])){
                    echo '<li><a href="profile.php">Mijn Profiel</a></li>';
                }
                ?>
            </ul>
        </li>
    </ul>
</nav>
    <div class="whiteOverlay">
        <h1>
            Account Aanmaken
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
                    echo '<p class="signupError">Een naam kan alleen letters bevatten!</p>';
            }
            elseif ($_GET["error"] == "passwordcheck"){
                    echo '<p class="signupError">De wachtwoorden komen niet overeen!</p>';
            }
            elseif ($_GET["error"] == "passwordlength"){
                    echo '<p class="signupError">Het wachtwoord moet minimaal 6 tekens hebben!</p>';
            }
            ?>
        <p>Vul hieronder uw gegevens in om een account aan te maken.</p>
        <p>Heeft u al een account? Log dan in door <a href="login.php">HIER</a> te klikken!</p>
        <form class="inputBoxes" action="includes/signup.inc.php" method="post">
            <input type="text" name="vnaam" placeholder="Voornaam">
            <input type="text" name="anaam" placeholder="Achternaam">
            <input type="text" name="email" placeholder="Email">
            <input type="password" name="passw" placeholder="Wachtwoord van minimaal 6 tekens">
            <input type="password" name="passw-repeat" placeholder="Wachtwoord herhalen">
            <button type="submit" name="signup-submit">Account Aanmaken</button>
        </form>
    </div>
</body>
</html>
