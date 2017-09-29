<?php

namespace ScooterSam\Menu\Commands;

use function app_path;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\File;
use function str_replace;

class UpdateMenu extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'menu:update';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		/*$menu = app('\\App\\Menus\\MainMenu');

		$menu::getInstance();
		$menu->items();

		dd($memu);*/

		//dd(app_path('Menus'));

		foreach (Storage::disk('app')->files('Menus') as $class) {
			$className = str_replace('.php', '', $class);
			//chmod(app_path('Menus/') . str_replace('Menus/', '', $className) . '.php', 400);
			$className = 'App\\Menus\\' . str_replace('Menus/', '', $className);
			$menu      = $className::getInstance();
			$menu->menu();
			$menu->items();
		}

		$this->line('Successfully updated menus.');

	}
}
