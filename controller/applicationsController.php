<?php

require_once __SITE_PATH . '/app/util.php';

class ApplicationsController extends BaseController
{
    public function index()
    {
        redirectIfNotLoggedIn();
        $ps = new ProjectsService();
        $as = new AppInvService();
        $this->registry->template->title = 'Applications';
        $this->registry->template->all_projects_applied = $as->allProjectsApplied($_SESSION['id']);
        $this->registry->template->user_map = $ps->userMap();
        $this->registry->template->username = $_SESSION['username'];
        $this->registry->template->show('applications_index');
    }

    public function accept()
    {
        redirectIfNotLoggedIn();
        $ais = new AppInvService();
        debug();
        $ais->accept_appinv(intval($_GET['project_id']), intval($_GET['user_id']), 'application');
        header('Location: ' . __SITE_URL . '/teamup.php?rt=projects/my');
    }

    public function reject()
    {
        redirectIfNotLoggedIn();
        $ais = new AppInvService();
        $ais->reject_appinv(intval($_GET['project_id']), intval($_GET['user_id']), 'application');
        header('Location: ' . __SITE_URL . '/teamup.php?rt=projects/my');
    }
};
