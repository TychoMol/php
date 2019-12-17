<?php
if (isset($_POST['login-submit'])) {

    require 'dhb.inc.php';

    $mail = $_POST['email'];
    $password = $_POST['passw'];

    if (empty($mail) || empty($password)) {
        header("Location: ../login.php?error=emptyfields");
        exit();
    }
    else {
        $sql = "SELECT * FROM accounts WHERE email=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../login.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $mail);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password, $row['passw']);
                if ($pwdCheck == false) {
                    header("Location: ../login.php?error=wrongpassword");
                    exit();
                }
                elseif ($pwdCheck == true) {
                    session_start();
                    $_SESSION['userID'] = $row['ID'];
                    $_SESSION['vnaam'] = $row['vnaam'];
                    $_SESSION['anaam'] = $row['anaam'];

                    header("Location: ../index.php?login=success&mail=".$mail);
                    exit();
                }
                else {
                    header("Location: ../login.php?error=wrongpassw");
                    exit();
                }
            }
            else {
                header("Location: ../login.php?error=noaccount");
                exit();
            }
        }
    }
}
else {
    header("Location: ../login.php");
    exit();
}