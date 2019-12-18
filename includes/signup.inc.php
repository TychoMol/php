<?php
if (isset($_POST['signup-submit'])){

    //connectie met database word gemaakt
    require 'dhb.inc.php';

    //de input vanuit createAcc.php wordt hier in variabelen gestopt.
    $voornaam = $_POST['vnaam'];
    $achternaam = $_POST['anaam'];
    $mail = $_POST['email'];
    $password = $_POST['passw'];
    $passwordRepeat = $_POST['passw-repeat'];

    //hier word gekeken of alles is ingevuld en daarna of het ook juiste informatie is
    if (empty($voornaam) ||  empty($achternaam) || empty($mail) || empty($password) || empty($passwordRepeat)){
        header("Location: ../createAcc.php?error=emptyfields&vnaam=". $voornaam . "&anaam=" . $achternaam ."&email=".$mail);
        exit();
    }
     elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
         header("Location: ../createAcc.php?error=invalidmail&vnaam=". $voornaam . "&anaam=" . $achternaam);
         exit();
     }
     elseif (!preg_match("/^[a-zA-Z ]*$/", $voornaam)) {
         header("Location: ../createAcc.php?error=onjuistenaam&anaam=" . $achternaam. "&email=".$mail);
         exit();
     }
     elseif (!preg_match("/^[a-zA-Z]*$/", $achternaam)) {
         header("Location: ../createAcc.php?error=onjuistenaam&vnaam=" . $voornaam. "&email=".$mail);
         exit();
     }
     elseif (strlen($password) < 6){
        header("Location: ../CreateAcc.php?error=passwordlength&vnaam=".$voornaam."&anaam=".$achternaam."&email=".$mail);
        exit();
     }
     elseif ($password !== $passwordRepeat){
         header("Location: ../createAcc.php?error=passwordcheck&vnaam=".$voornaam."&anaam=".$achternaam."&email=".$mail);
         exit();
     }
     else{
        //de statement wordt prepared om sql injecties te voorkomen en email geselecteerd vanuit de database
        $sql = "SELECT email FROM accounts WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../createAcc.php?error=sqlerror1");
            exit();
        }
        //er word gekeken of de eerder geselecteerde email al bestaat op de website.
        else {
            mysqli_stmt_bind_param($stmt, "s", $mail);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck = mysqli_stmt_num_rows($stmt);
            if ($resultcheck > 0) {
                header("Location: ../createAcc.php?error=emailingebruik&vnaam=" . $voornaam . "&anaam=" . $achternaam);
                exit();
            }
            //hier word de input voorbereid ook met een prepared statement.
            else {
                $sql = "INSERT INTO accounts (vnaam, anaam, email, passw) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../createAcc.php?error=sqlerror2");
                    exit();
                }
                //wachtwoord wordt gehashed en vervolgens word alles in de database gezet
                else {
                    $hashedPWD = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "ssss", $voornaam, $achternaam, $mail, $hashedPWD);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    header("Location: ../createAcc.php?signup=success");
                    exit();
                }
            }
        }
    }
}
else {
    header("Location: ../createAcc.php");
    exit();
}
