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

	function modifyPath($parentPath, $key) {
		$this->path = $parentPath . '/' . $key;
	}

	function addNewNode($path, $title)
	{
		$node = $this->getNodeByPath($path);
		$newNode = new self($title);
		array_push($node->menuItems, $newNode);
		$last_key = array_key_last($node->menuItems);
		$node->menuItems->modifyPath($node->path, $last_key);
	}

	function getNodeByPath($path) {
		if ($this->path == $path)
			return $this;
		else {
			$arr = explode('/', $path);
			if (!isset($arr[1]) || !isset($this->menuItems[$arr[1]]))
				return NULL;
			unset($arr[0]);
			$newPath = implode($arr);
			$nextNode = $this->menuItems[$arr[1]];
			$node = $nextNode->getNodeByPath($newPath);
			return $node;
		}
	}
}