<?php

namespace ScooterSam\Menu\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\Console\Input\InputOption;

class CreateMenu extends GeneratorCommand
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'menu:make {name}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create a new menu builder class.';

	public function getStub()
	{
		return __DIR__ . '/../Builder/stubs/Menu.stub';
	}

	public function fire()
	{
		return parent::fire();
	}

	protected function getDefaultNamespace($rootNamespace)
	{
		return "\App\Menus";
	}

	protected function getOptions()
	{
		return ['extend', 'e', InputOption::VALUE_NONE, 'Generate a menu builder class.'];
	}
}
