<?php

class IndexController extends BaseController
{
	public function index()
	{
		if (isset($_SESSION['username'])) {
			header('Location: ' . __SITE_URL . '/teamup.php?rt=projects');
		}
		else {
			header('Location: ' . __SITE_URL . '/teamup.php?rt=login');
		}
	}
};
