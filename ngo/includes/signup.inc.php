<?php
if (isset($_POST["submit"])) {
    // Sanitize user input
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_STRING);
    $pwd = filter_input(INPUT_POST, "pwd", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit();
    }

    // Include necessary files
    require_once "../classes/dbh.classes.php";
    require_once "../classes/signup.classes.php";
    require_once "../classes/signup-contr.classes.php";

    // Create SignupContr object and signup user
    $signup = new SignupContr($username, $pwd, $email);
    try {
        $signup->signupUser();
        header("Location: http://localhost/ngo/logged.html");
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    header("Location: ../trial.php");
    exit();
}
?>
