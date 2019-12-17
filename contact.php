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
        <p>Ik heb een praktijk aan huis in Ouderkerk a/d IJssel (Krimpenerwaard).
            <p>De praktijk is makkelijk bereikbaar met de auto of met de bus. Gratis parkeergelegenheid vlakbij de praktijk.</p>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2460.1370015197244!2d4.634477415753111!3d51.93145457970711!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c5d32abc1bc0ab%3A0xb4374601ea1e328b!2sTalpatherapie!5e0!3m2!1sen!2snl!4v1576542323745!5m2!1sen!2snl" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
        <br>
            <p>Talpa, praktijk voor psychosociale therapie</p>
            <p>KvK nr: 24461359</p>
            <p>Ilse Mol</p>
            <p>Leeuwerikhof 5</p>
            <p>Tel.: 06 – 45 34 17 19</p>
            <p>e-mail: talpatherapie@gmail.com</p>
        </p>
    </div>
</body>
</html>
