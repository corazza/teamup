<?php

require_once __SITE_PATH . '/app/util.php';

class ProjectsController extends BaseController
{
    private function redirectIfNotLoggedIn() {
        if (!isset($_SESSION['username'])) {
            header('Location: ' . __SITE_URL . '/teamup.php');
        }
    }

    public function index()
    {
        $this->redirectIfNotLoggedIn();
        $ps = new ProjectsService();
        $this->registry->template->title = 'All projects';
        $this->registry->template->all_projects = $ps->allProjects();
        $this->registry->template->user_map = $ps->userMap();
        $this->registry->template->username = $_SESSION['username'];
        $this->registry->template->show('projects_index');
    }

    public function single() {
        $this->redirectIfNotLoggedIn();
        $project_id = $_GET['id'];
        $ps = new ProjectsService();
        $this->registry->template->title = 'All projects';
        $this->registry->template->project = $ps->getProject($project_id);
        $this->registry->template->user_map = $ps->userMap();
        $this->registry->template->username = $_SESSION['username'];
        $this->registry->template->show('single_project_index');
    }
};
