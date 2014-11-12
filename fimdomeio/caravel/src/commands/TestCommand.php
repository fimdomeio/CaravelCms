<?php namespace Fimdomeio\Caravel;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class TestCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'test';

	/**
	 * The console command description.
	 *
	 * @var string
	 */


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
	public function fire()
	{
		chdir(getcwd().'/workbench/fimdomeio/caravel');
		$args = '';
		if($this->argument('options') == 'append'){
			$args .= ' --append-snippets';
		}
		if($this->argument('options') == 'dl'){
			$args = ' -dl';
		}
		if($this->argument('options') == 'stop-on-failure'){
			$args = ' --stop-on-failure';
		}

		passthru ('vendor/bin/behat'.$args);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('options', InputArgument::OPTIONAL, 'behat options.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			//array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}
}
