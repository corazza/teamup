<?php

require_once __SITE_PATH . '/app/util.php';

class ProjectsController extends BaseController
{
    public function index()
    {
        $this->registry->template->title = 'All projects';
        $this->registry->template->show('projects_index');
        debug();
    }
};
