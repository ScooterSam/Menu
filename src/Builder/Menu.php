<?php
/**
 * Created by PhpStorm.
 * User: Sam8t
 * Date: 28/09/2017
 * Time: 3:19 PM
 */

namespace ScooterSam\Menu;


use function array_only;
use ScooterSam\Menu\Models\MenuItem;
use function str_slug;

class Menu
{

	public $items;
	public $name;
	public $slug;
	public $description;
	public $menu;

	public function __construct($name, $slug = null)
	{
		$this->items = [];
		$this->name  = $name;
		$this->slug  = $slug ? $slug : str_slug($slug);
	}

	/**
	 * Adds an item to the menu
	 *
	 * @param      $title
	 * @param null $slug
	 *
	 * @return Item
	 */
	public function add($title, $slug = null)
	{
		if ($slug == null) {
			$slug = str_slug($title, '_');
		}

		$item          = (new Item())->title($title)->slug($slug);
		$this->items[] = $item;

		return $item;
	}

	/**
	 * @param mixed $description
	 *
	 * @return $this
	 */
	public function setDescription($description)
	{
		$this->description = $description;

		return $this;
	}


	/**
	 * @return Models\Menu
	 */
	public function create()
	{
		if ($menu = \ScooterSam\Menu\Models\Menu::where('slug', $this->slug)->first()) {

			if ($menu->title !== $this->name) {
				$menu->title = $this->name;
				$menu->save();
			}

			if ($menu->slug !== $this->slug) {
				$menu->slug = $this->slug;
				$menu->save();
			}

			if ($menu->description !== $this->description) {
				$menu->description = $this->description;
				$menu->save();
			}
			$menu->load('items');
			$this->menu = $menu;

			return $menu;
		}

		$menu              = new \ScooterSam\Menu\Models\Menu();
		$menu->title       = $this->name;
		$menu->slug        = $this->slug;
		$menu->description = $this->description;
		$menu->save();
		$menu->refresh();
		$menu->load('items');
		$this->menu = $menu;

		return $menu;
	}

	public function addItems()
	{
		foreach ($this->items as $item) {
			$this->addItem($item, null);
		}
	}

	public function addItem($item, $parent = null)
	{
		$menuItem = MenuItem::updateOrCreate(
			array_only(
				$item->toArray($this->menu->id, $parent == null ? null : $parent->id),
				['menu_id', 'slug']
			),
			$item->toArray($this->menu->id, $parent == null ? null : $parent->id)
		);

		if ($item->children != null) {
			foreach ($item->children->items as $child) {
				$this->addItem($child, $menuItem);
			}
		}
	}
}