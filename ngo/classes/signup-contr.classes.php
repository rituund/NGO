<?php 
class SignupContr extends Signup {
    protected $username;
    protected $pwd;
    protected $email;

    public function __construct($username, $pwd, $email) {
        $this->username = $username;
        $this->pwd = $pwd;
        $this->email = $email;
    }

    public function signupUser() {
        if (!$this->emptyInput()) {
            $_SESSION['error'] = "Please fill in all fields.";
            header("Location: ../trial.php");
            exit();
        }
        if (!$this->invalidUsername()) {
            $_SESSION['error'] = "Invalid username. Use only letters and numbers.";
            header("Location: ../trial.php");
            exit();
        }
        if (!$this->invalidEmail()) {
            $_SESSION['error'] = "Invalid email address.";
            header("Location: ../trial.php");
            exit();
        }
        if ($this->userTakenCheck()) {
            $_SESSION['error'] = "Username or email already taken.";
            header("Location: ../trial.php");
            exit();
        }
    
        $this->setUser($this->username, $this->email, $this->pwd);
        header("Location: ../logged.html");
        exit();
    }
    

    private function emptyInput() {
        return !empty($this->username) && !empty($this->pwd) && !empty($this->email);
    }

    private function invalidUsername() {
        return preg_match("/^[a-zA-Z0-9]*$/", $this->username);
    }

    private function invalidEmail() {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    private function userTakenCheck() {
        $stmt = $this->connect()->prepare('SELECT user_id FROM donor WHERE username=? OR email=?;');
        if (!$stmt->execute(array($this->username, $this->email))) {
            throw new Exception("Failed to fetch user");
        }

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return count($result) > 0;
    }
}
