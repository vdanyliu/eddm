<?php

namespace models;

use core\MenuNode;
use core\Model;
use config\Config;

class JS extends Model
{
	public function getListOfMenus() {
		if(!isset($_SESSION['menus'])) {
			$json['menu'] = NULL;
			echo json_encode($json);
			return;
		}
		$arr = array();
		foreach ($_SESSION['menus'] as $key => $MenuNode) {
			$arr[$key] = $MenuNode->getTitle();
		}
		$json['menus'] = $this->generateMenuItems($arr);
		echo json_encode($json);
	}

	private function generateMenuItems($arr) {
		ob_start();
		foreach ($arr as $key => $menuTitle) {
			echo "<option value='$key'>$menuTitle</option>";
		}
		return ob_get_clean();
	}

	private function getMenuHeadObjectByKey($key) {
		$objArray = $_SESSION['menus'];
		return $objArray[$key];
	}

	private function generateMenuItemsFromObject(MenuNode $menuNode) {
		ob_start();
		$path = $menuNode->getPath();
		echo "<ul id = $path>";
		echo "<li id = '$path'>+New item</li>";
		$objsArr = $menuNode->getMenuNodeArr();
		foreach ($objsArr as $node) {
			$path = $node->getPath();
			$title = $node->getTitle();
			echo "<li id = $path>$title</li>";
			echo "<div id = $path></div>";
		}
		echo "</ul>";
		return ob_get_clean();
	}

	public function getMenuHead() {
		$key = $_POST['key'];
		$menuHead = $this->getMenuHeadObjectByKey($key);
		$result = $this->generateMenuItemsFromObject($menuHead);
		$json['head'] = $result;
		echo json_encode($json);
	}
}