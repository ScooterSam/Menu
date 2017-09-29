<?php

namespace ScooterSam\Menu;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use function is_dir;
use League\Flysystem\File;
use function mkdir;
use ScooterSam\Menu\Commands\CreateMenu;
use ScooterSam\Menu\Commands\UpdateMenu;
use function storage_path;

class MenuServiceProvider extends ServiceProvider
{
	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
	}

	/**
	 * Register any package services.
	 *
	 * @return void
	 */
	public function register()
	{

		/*if (!is_dir(storage_path('/app/menus'))) {
			mkdir(storage_path('/app/menus'), 0777, true);
		}*/

		if ($this->app->runningInConsole()) {
			$this->commands([
				UpdateMenu::class,
				CreateMenu::class,
			]);
		}

		$this->app->singleton('menu', function ($app) {
			return new MenuManager($app);
		});
		$this->app->alias('menu', MenuManager::class);
		view()->share('menu', app('menu'));
	}
}