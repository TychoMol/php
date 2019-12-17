<?php
if (isset($_POST['signup-submit'])){

    require 'dhb.inc.php';

    $voornaam = $_POST['vnaam'];
    $achternaam = $_POST['anaam'];
    $mail = $_POST['email'];
    $password = $_POST['passw'];
    $passwordRepeat = $_POST['passw-repeat'];

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

        $sql = "SELECT email FROM accounts WHERE email=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../createAcc.php?error=sqlerror1");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $mail);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultcheck = mysqli_stmt_num_rows($stmt);
            if ($resultcheck > 0) {
                header("Location: ../createAcc.php?error=emailingebruik&vnaam=" . $voornaam . "&anaam=" . $achternaam);
                exit();
            }
            else {
                $sql = "INSERT INTO accounts (vnaam, anaam, email, passw) VALUES (?, ?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../createAcc.php?error=sqlerror2");
                    exit();
                }
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
