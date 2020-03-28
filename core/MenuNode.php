<?php


namespace core;


class MenuNode
{
	public $path;
	public $title;
	public $menuItems;

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
		$newNode = new self($title);
		array_push($node->menuItems, $newNode);
		$last_key = array_key_last($node->menuItems);
		$newNode->modifyPath($node->path, $last_key);
	}

	private function modifyPath($parentPath, $key) {
		$this->path = $parentPath . '/' . $key;
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
}