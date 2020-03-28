<?php

	namespace controllers;

	use config\Config;
	use core\Controller;
	use core\MenuNode;

	class MainController extends Controller
	{
		public function indexAction()
		{
			$test = new MenuNode("1st");
			$test->addNewNode('root', 'Тест');
			$test->addNewNode('root', 'Тест');
			$test->addNewNode('root', 'Тест');
			$test->addNewNode('root/0', 'Тест');
			$test->addNewNode('root/1', 'Тест');
			$test->addNewNode('root/2', 'Тест');
			$test->addNewNode('root/3', 'Тест');
			$test->addNewNode('root/1/0', 'Тест');
			$test->addNewNode('root/1/11', 'Тест');
			debug($test);
			$test->deleteNode('root/0');
			$test->deleteNode('root/2');
			$test->deleteNode('root/3');
			$test->deleteNode('root/1');
			debug($test);
			$arr = [];
			$this->view->render("index page", $arr);
		}
	}
