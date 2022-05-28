<?php

require_once __SITE_PATH . '/app/util.php';

class ProjectsController extends BaseController
{
    public function index()
    {
        $ps = new ProjectsService();
        $this->registry->template->title = 'All projects';
        $this->registry->template->all_projects = $ps->allProjects();
        $this->registry->template->user_map = $ps->userMap();
        $this->registry->template->username = $_SESSION['username'];
        $this->registry->template->show('projects_index');
    }
};
