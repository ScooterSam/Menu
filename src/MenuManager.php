<?php

namespace ScooterSam\Menu;

use Exception;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Cache;
use ScooterSam\Menu\Models\Menu;

class MenuManager
{

	/**
	 * @var App
	 */
	private $app;

	private $menus;

	public function __construct(Application $app)
	{
		$this->app   = $app;
		$this->menus = [];
	}

	public function add($slug)
	{
		if ($menu = Menu::where('slug', $slug)->with('items')->first()) {
			return $menu;
		}

		return null;
	}

	public function get($name)
	{
		return Cache::remember("menu.${name}", 60, function () use ($name) {
			$menu = Menu::where('slug', $name)->with('items', 'items.children')->first();

			if (!$menu) {
				throw new Exception('Menu does not exist.');
			}

			return $menu;
		});
	}

}
