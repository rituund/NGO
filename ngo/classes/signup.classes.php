<?php
class Signup extends Dbh {
    protected $username;
    protected $email;
    protected $password;

    public function __construct($username, $email, $password) {
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }

    protected function setUser($username, $email, $pwd) {
        $stmt = $this->connect()->prepare('INSERT INTO donor (username, email, pwd) VALUES (?, ?, ?);');

        if (!$stmt->execute(array($username, $email, $pwd))) {
            throw new Exception("Failed to insert user");
        }
    }

    protected function checkUser($username, $email) {
        $stmt = $this->connect()->prepare('SELECT user_id FROM donor WHERE username=? OR email=?;');
        if (!$stmt->execute(array($username, $email))) {
            throw new Exception("Failed to fetch user");
        }

        $loginData = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($loginData) == 0) {
            return false;
        }
        return true;
    }
}
?>
