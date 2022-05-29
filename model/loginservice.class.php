<?php

require_once __DIR__ . '/../app/database/db.class.php';

class LoginResult
{
}

class LoginFailure extends LoginResult
{
    public string $error_message;

    public function __construct($error_message) {
        $this->error_message = $error_message;
    }

    public function success() {
        return false;
    }
}

class LoginSuccess extends LoginResult
{
    public function success() {
        return true;
    }
};

class LoginService
{
    public function attempt($username, $password)
    {
        $db = DB::getConnection();

        try {
            $st = $db->prepare('SELECT id, username, password_hash, has_registered FROM dz2_users WHERE username=:username');
            $st->execute(array('username' => $_POST['username']));
        } catch (PDOException $e) {
            exit('DB error (LoginService.attempt): ' . $e->getMessage());
        }

        $row = $st->fetch();

        if ($row === false) {
            return new LoginFailure('Korisnik s tim imenom ne postoji.');
        } else if ($row['has_registered'] === '0') {
            return new LoginFailure('Korisnik s tim imenom se nije još registrirao. Provjerite e-mail.');
        } else if (!password_verify($_POST['password'], $row['password_hash'])) {
            return new LoginFailure('Lozinka nije ispravna.');
        } else {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['id'] = $row['id'];
            return new LoginSuccess();
        }
    }

    public function logout() {
        unset($_SESSION['username']);
    }
};
