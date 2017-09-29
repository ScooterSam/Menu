<?php
/**
 * Created by PhpStorm.
 * User: Sam8t
 * Date: 28/09/2017
 * Time: 3:20 PM
 */

namespace ScooterSam\Menu;

use function json_encode;

class Item
{

	public $title;
	public $slug;
	public $route;
	public $children;
	public $disabled    = false;
	public $description = "";
	public $extraData   = [];
	public $header      = false;


	/**
	 * Allows you to manage and access children items.
	 *
	 * @return Menu
	 */
	public function children()
	{
		if ($this->children == null) {
			$this->children = new Menu($this->title);
		}

		return $this->children;
	}

	/**
	 * @param mixed $title
	 *
	 * @return Item
	 */
	public function title($title)
	{
		$this->title = $title;

		return $this;
	}

	/**
	 * @param mixed $slug
	 *
	 * @return Item
	 */
	public function slug($slug)
	{
		$this->slug = $slug;

		return $this;
	}

	public function route($name, $parameters = [])
	{
		$this->route = ['route' => $name, 'parameters' => $parameters];

		return $this;
	}

	/**
	 * @param mixed $disabled
	 *
	 * @return Item
	 */
	public function disabled($disabled = true)
	{
		$this->disabled = $disabled;

		return $this;
	}

	/**
	 * @param mixed $description
	 *
	 * @return Item
	 */
	public function description($description)
	{
		$this->description = $description;

		return $this;
	}

	/**
	 * Set extra data such as icons.
	 *
	 * @param $key
	 * @param $value
	 *
	 * @return Item
	 * @internal param mixed $extraData
	 *
	 */
	public function extra($key, $value)
	{
		$this->extraData[$key] = $value;

		return $this;
	}

	public function setExtraData($data)
	{
		$this->extraData = $data;

		return $this;
	}

	/**
	 * @param bool $header
	 *
	 * @return $this
	 */
	public function header($header = true)
	{
		$this->header = $header;

		return $this;
	}

	/**
	 * Only used for storing and updating a menu item
	 *
	 * @param      $menuId
	 * @param null $parentId
	 *
	 * @return array
	 */
	public function toArray($menuId, $parentId = null)
	{
		return [
			'menu_id'     => $menuId,
			'title'       => $this->title,
			'slug'        => $this->slug,
			'route'       => $this->route['route'],
			'parameters'  => $this->route['parameters'],
			'disabled'    => $this->disabled,
			'description' => $this->description,
			'header'      => $this->header,
			'extra'       => $this->extraData,
			'parent_id'   => $parentId,
			'is_parent'   => $this->children != null,
		];
	}


}