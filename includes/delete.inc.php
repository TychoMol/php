<?php
session_start();

if (isset($_POST['acdelete'])){

    require 'dhb.inc.php';

    $delID = $_SESSION['userID'];

    $select = "DELETE from accounts WHERE ID='$delID'";
    $query = mysqli_query($conn, $select) or die($select);
    header("Location: ../index.php?accountdeleted");
    session_unset();
    session_destroy();
}
else {
    header('Location: ./profile.php');
}
