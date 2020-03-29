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
		$objArr = $menuNode->getMenuNodeArr();
		foreach ($objArr as $node) {

		}
	}

	public function getMenuHead() {
		$key = $_POST['key'];
		$menuHead = $this->getMenuHeadObjectByKey($key);
		$result = $this->generateMenuItemsFromObject($menuHead);
	}
}