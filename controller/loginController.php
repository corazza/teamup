<?php

require_once __SITE_PATH . '/app/util.php';

class LoginController extends BaseController
{
    private function index_with_error($error_message)
    {
        $this->registry->template->title = 'Login';
        $this->registry->template->errorMessage = $error_message;
        $this->registry->template->show('login_index');
        exit();
    }

    public function index()
    {
        $this->index_with_error("");
    }

    public function attempt()
    {
        if (!isset($_POST['username']) || !isset($_POST['password']) || strlen($_POST['username']) == 0 || strlen($_POST['password']) == 0) {
            $this->index_with_error('Upisite ime i lozinku');
        }

        if (!preg_match('/^[a-zA-Z]{3,10}$/', $_POST['username'])) {
            $this->index_with_error('Korisničko ime treba imati između 3 i 10 slova.');
        }

        $ls = new LoginService();
        $login_result = $ls->attempt($_POST['username'], $_POST['password']);

        if ($login_result->success()) {
			header('Location: ' . __SITE_URL . '/teamup.php?rt=projects');
        } else {
            $this->index_with_error($login_result->error_message);
        }
    }
};
