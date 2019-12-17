<?php
session_start();

if (isset($_POST['update-info'])) {

    require 'dhb.inc.php';

    $userID = $_SESSION['userID'];
    $voornaam = $_POST['vnaam'];
    $achternaam = $_POST['anaam'];
    $mail = $_POST['email'];
    $password = $_POST['passw'];
    $passwordRepeat = $_POST['passw-repeat'];

    if (empty($voornaam) || empty($achternaam) || empty($mail) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../profile.php?error=emptyfields&vnaam=" . $voornaam . "&anaam=" . $achternaam . "&email=" . $mail);
        exit();
    } elseif (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../profile.php?error=invalidmail&vnaam=" . $voornaam . "&anaam=" . $achternaam);
        exit();
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $voornaam)) {
        header("Location: ../profile.php?error=onjuistenaam&anaam=" . $achternaam . "&email=" . $mail);
        exit();
    } elseif (!preg_match("/^[a-zA-Z]*$/", $achternaam)) {
        header("Location: ../profile.php?error=onjuistenaam&vnaam=" . $voornaam . "&email=" . $mail);
        exit();
    } elseif (strlen($password) < 6){
        header("Location: ../CreateAcc.php?error=passwordlength&vnaam=".$voornaam."&anaam=".$achternaam."&email=".$mail);
        exit();
    } elseif ($password !== $passwordRepeat) {
        header("Location: ../profile.php?error=passwordcheck&vnaam=" . $voornaam . "&anaam=" . $achternaam . "&email=" . $mail);
        exit();
    }
    else {

        $sql = "SELECT email FROM accounts WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../profile.php?error=sqlerror1");
            exit();
        }
        else {
            $hashedPWD = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE accounts SET vnaam='$voornaam',anaam='$achternaam',email='$mail',passw='$hashedPWD' WHERE ID='$userID'";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../profile.php?error=sqlerror2");
                exit();
            } else {
                mysqli_stmt_bind_param($stmt, "ssss", $voornaam, $achternaam, $mail, $hashedPWD);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                header("Location: ../profile.php?update=success");
                exit();
            }
        }
    }
}
else {
    header('Location: ../profile.php');
}
