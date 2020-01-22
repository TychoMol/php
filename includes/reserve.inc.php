<?php
session_start();

if (isset($_POST['reserveren'])){
    require 'dhb.inc.php';

    $time = $_POST['tijd'];
    $date = $_POST['datum'];
    $email = $_SESSION['email'];
    $vnaam = $_SESSION['vnaam'];
    $anaam = $_SESSION['anaam'];
    $userID = $_SESSION['userID'];

    $sql = "SELECT email FROM reserveringen WHERE email=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../index.php?error=sqlerror");
    }
    else{
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $resultcheck = mysqli_stmt_num_rows($stmt);
        if ($resultcheck > 0){
            header("Location: ../index.php?error=HAafspraak");
            exit();
        }
        else{
            $sql = "INSERT INTO reserveringen (time, date, email, vnaam, anaam, uID) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../index.php?error=sqlerror2");
            }
            else{
                mysqli_stmt_bind_param($stmt, "ssssss", $time, $date, $email, $vnaam, $anaam, $userID);
                mysqli_stmt_execute($stmt);
                mysqli_store_result($stmt);
                header("Location: ../index.php?reservering=success");
                exit();
            }
        }
    }
}

else{
    header("Location: ../index.php?nope");
}
