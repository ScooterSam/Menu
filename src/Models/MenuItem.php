<?php

namespace ScooterSam\Menu\Models;

use Illuminate\Database\Eloquent\Model;
use function json_decode;
use function json_encode;
use ScooterSam\Menu\Traits\Item;

class MenuItem extends Model
{
	use Item;

	protected $guarded = ['id'];

	public function children()
	{
		return $this->hasMany(MenuItem::class, 'parent_id', 'id');
	}

	public function setParametersAttribute($value)
	{
		$this->attributes['parameters'] = json_encode($value);
	}

	public function getParametersAttribute($value)
	{
		return json_decode($value);
	}

	public function setExtraAttribute($value)
	{
		$this->attributes['extra'] = json_encode($value);
	}

	public function getExtraAttribute($value)
	{
		return json_decode($value);
	}

}
