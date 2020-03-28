<?php

	namespace controllers;

	use config\Config;
	use core\Controller;

	class MainController extends Controller
	{
		public function indexAction()
		{
			$arr = [];
			$this->view->render("index page", $arr);
		}
	}
