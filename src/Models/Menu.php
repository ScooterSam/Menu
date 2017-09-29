<?php

namespace ScooterSam\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
	public function items()
	{
		return $this->hasMany(MenuItem::class);
	}

	/**
	 * Get an instance of the menu to use
	 *
	 * @return mixed
	 */
	public function menu()
	{
		return app('menu')->get($this->slug);
	}

}
