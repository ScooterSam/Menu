<?php
/**
 * Created by PhpStorm.
 * User: Sam8t
 * Date: 21/09/2017
 * Time: 4:40 PM
 */

namespace ScooterSam\Menu\Builder;


class Singleton
{

	public static function getInstance()
	{
		static $instance = null;
		if ($instance === null) {
			return $instance = new static;
		}

		return $instance;
	}

	protected function __construct()
	{
	}

	private function __clone()
	{
		// TODO: Implement __clone() method.
	}

	private function __wakeup()
	{
		// TODO: Implement __wakeup() method.
	}

}