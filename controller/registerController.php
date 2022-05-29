<?php

require_once __SITE_PATH . '/app/util.php';

class RegisterController extends BaseController
{
    private function index_with_error($error_message)
    {
        $this->registry->template->title = 'Register';
        $this->registry->template->errorMessage = $error_message;
        $this->registry->template->show('register_index');
    }

    public function index()
    {
        $this->index_with_error("");
    }

    public function attempt()
    {
        if (!isset($_POST['username']) || !isset($_POST['password']) || strlen($_POST['username']) == 0 || strlen($_POST['password']) == 0) {
            $this->index_with_error('Upisite ime i lozinku');
            exit();
        }

        if (!preg_match('/^[a-zA-Z]{3,10}$/', $_POST['username'])) {
            $this->index_with_error('Korisničko ime treba imati između 3 i 10 slova.');
            exit();
        }

        $ls = new LoginService();
        $login_result = $ls->attempt_register($_POST['username'], $_POST['password']);

        if ($login_result->success()) {
            header('Location: ' . __SITE_URL . '/teamup.php?rt=register');
        } else {
            $this->index_with_error($login_result->error_message);
        }
    }

    public function verify()
    {
        if (!isset($_GET['niz']) || !preg_match('/^[a-z]{20}$/', $_GET['niz'])) {
            exit('Nešto ne valja s nizom.');
        }

        $db = DB::getConnection();

        try {
            $st = $db->prepare('SELECT * FROM dz2_users WHERE registration_sequence=:reg_seq');
            $st->execute(array('reg_seq' => $_GET['niz']));
        } catch (PDOException $e) {
            exit('Greška u bazi: ' . $e->getMessage());
        }

        $row = $st->fetch();

        if ($st->rowCount() !== 1) {
            exit('Taj registracijski niz ima ' . $st->rowCount() . 'korisnika, a treba biti točno 1 takav.');
        }
        else {
            try {
                $st = $db->prepare('UPDATE dz2_users SET has_registered=1 WHERE registration_sequence=:reg_seq');
                $st->execute(array('reg_seq' => $_GET['niz']));
            } catch (PDOException $e) {
                exit('Greška u bazi: ' . $e->getMessage());
            }

            exit('Registracija uspjesna');
        }
    }

    public function logout()
    {
        $ls = new LoginService();
        $ls->logout();
        $this->index_with_error("");
    }
}
