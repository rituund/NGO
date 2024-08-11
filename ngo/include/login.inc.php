<?php
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $pwd = $_POST["pwd"];

    include "../classes/dbh.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";

    $login = new loginContr($username, $pwd);
    $login->loginUser();
} else {
    header("Location: ../trial.php");
    exit();
}
?>
