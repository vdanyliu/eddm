<?php


namespace core;


class MenuNode
{
	private $path;
	private $title;
	private $menuItems;

	/**
	 * MenuNode constructor.
	 * @param $title //menu title
	 */
	function __construct($title)
	{
		$this->menuItems = array();
		$this->path = "root";
		$this->title = $title;
	}

	function __clone()
	{
		$this->menuItems = array();
	}

	function deleteNode($path) {
		$arr = explode('/', $path);
		$key = $arr[array_key_last($arr)];
		unset($arr[array_key_last($arr)]);
		$newPath = implode('/', $arr);
		$node = $this->getNodeByPath($newPath);
		unset($node->menuItems[$key]);
	}

	function addNewNode($path, $title)
	{
		if (!$node = $this->getNodeByPath($path)) {
			return;
		}
		$newNode = clone $node;
		array_push($node->menuItems, $newNode);
		$last_key = array_key_last($node->menuItems);
		$newNode->path = $newNode->path . '/' . $last_key;
		$newNode->title = $title;
	}

	private function getNodeByPath($path, $deepLevel = 0) {
		if ($this->path == $path)
			return $this;
		else {
			$arr = explode('/', $path);
			if (!isset($arr[1+$deepLevel]) || !isset($this->menuItems[$arr[1+$deepLevel]])) {
				printf("Такого меню не существует '%s'\n", $path);
				return NULL;
			}
			$nextNode = $this->menuItems[$arr[1+$deepLevel]];
			$deepLevel++;
			$node = $nextNode->getNodeByPath($path, $deepLevel);
			return $node;
		}
	}

	public function getTitle() {
		return $this->title;
	}

	public function getPath() {
		return $this->path;
	}

	public function getMenuNodeArr() {
		return $this->menuItems;
	}
}