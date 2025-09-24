<?php
class Login
{
    private $conn;

    public function __construct($connection)
    {
        $this->conn = $connection;
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function isLoggedIn()
    {
        return isset($_SESSION['id_user']);
    }

    public function requireLogin($redirect = 'AksiLogin.php')
    {
        if (!$this->isLoggedIn()) {
            header("Location: $redirect");
            exit();
        }
    }

    public function authenticate($username_user, $password)
    {
        if (empty($username_user) || empty($password)) {
            return false;
        }

        $stmt = $this->conn->prepare("SELECT id_user, username_user, password FROM users WHERE username_user = ?");
        $stmt->bind_param("s", $username_user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            if ($password === $user['password']) {
                $_SESSION['id_user'] = $user['id_user'];
                $_SESSION['username_user'] = $user['username_user'];
                return true;
            }
        }

        return false;
    }

    public function logout()
    {
        session_destroy();
    }


    public function getUserId()
    {
        return $_SESSION['id_user'] ?? null;
    }

    public function getUsername()
    {
        return $_SESSION['username_user'] ?? null;
    }
}
?>