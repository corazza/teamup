<?php

require_once __SITE_PATH . '/app/util.php';

class ApplicationsController extends BaseController
{
    public function index()
    {
        redirectIfNotLoggedIn();
        $ais = new AppInvService();
        $ps = new ProjectsService();
        $this->registry->template->title = 'Applications';
        $this->registry->template->all_projects_applied = $ais->allProjectsApplied($_SESSION['id']);
        $this->registry->template->user_map = $ps->userMap();
        $this->registry->template->username = $_SESSION['username'];
        $this->registry->template->show('applications_index');
    }
};
