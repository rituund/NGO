<?php

// Assuming Dbh class is properly defined and included before Login class

class Login extends Dbh {
    protected function getUser($username, $pwd) {
        $stmt = $this->connect()->prepare('SELECT * FROM donor WHERE username = :username OR email = :email;');
        $stmt->execute(array(':username' => $username, ':email' => $username));
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            header("Location: ../trial.php?error=usernotfound");
            exit();
        }

        // Start session if user found
        session_start();
        $_SESSION["userid"] = $user["user_id"];
        $_SESSION["username"] = $user["username"];
        header("Location: ../logged.html");
        exit();
    }
}
?>

