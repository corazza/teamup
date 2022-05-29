<?php

require_once __SITE_PATH . '/app/util.php';

class InvitationsController extends BaseController
{
    public function index()
    {
        redirectIfNotLoggedIn();
        $ais = new AppInvService();
        $ps = new ProjectsService();
        $this->registry->template->title = 'Invitations';
        $this->registry->template->all_projects_invited = $ais->allProjectsInvited($_SESSION['id']);
        $this->registry->template->user_map = $ps->userMap();
        $this->registry->template->username = $_SESSION['username'];
        $this->registry->template->show('invitations_index');
    }

    public function accept() {
        redirectIfNotLoggedIn();
        $ais = new AppInvService();
        $ais->accept_appinv(intval($_GET['id']), intval($_SESSION['id']), 'invitation');
        header('Location: ' . __SITE_URL . '/teamup.php?rt=invitations');
    }

    public function reject() {
        redirectIfNotLoggedIn();
        $ais = new AppInvService();
        $ais->reject_appinv(intval($_GET['id']), intval($_SESSION['id']), 'invitation');
        header('Location: ' . __SITE_URL . '/teamup.php?rt=invitations');        
    }
};
