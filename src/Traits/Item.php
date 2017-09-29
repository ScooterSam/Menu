<?php
/**
 * Created by PhpStorm.
 * User: Sam8t
 * Date: 28/09/2017
 * Time: 7:29 PM
 */

namespace ScooterSam\Menu\Traits;


use Illuminate\Support\Facades\Cache;

trait Item
{

	/**
	 * Checks if the current item is active
	 *
	 * @param bool $checkChildren
	 *
	 * @return bool
	 */
	public function isActive($checkChildren = true)
	{
		if ($this->route === null) {
			return false;
		}

		if (request()->url() === $this->url()) {
			return true;
		}

		if (request()->route()->getName() === $this->route) {
			return true;
		}

		if ($checkChildren && $this->hasActiveChildren()) {
			return true;
		}

		return false;
	}

	/**
	 * Checks if there is an active child
	 *
	 * @return bool
	 */
	public function hasActiveChildren()
	{
		if ($this->hasChildren()) {
			return false;
		}

		foreach ($this->getChildren() as $child) {
			if ($child->isActive()) {
				return true;
			}
		}

		return false;
	}

	public function url()
	{
		return route($this->route, $this->parameters);
	}

	public function hasChildren()
	{
		return $this->getChildren()->first() ? true : false;
	}

	public function getChildren()
	{
		return Cache::remember("menu.{$this->menu_id}.item.{$this->id}.children", 60, function () {
			return $this->children;
		});
	}

	public function isHeader()
	{
		return $this->header == true;
	}

	public function disabled()
	{
		return $this->disabled == true;
	}
}