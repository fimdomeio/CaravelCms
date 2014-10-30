<?php namespace Fimdomeio\Caravel;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use lessc;

class BuildCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'build';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Renders less concatenates and moves js.';

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
		$deployDir = base_path()."/public/packages/fimdomeio/caravel/";
		$caravelDir = base_path().'/workbench/fimdomeio/caravel/';
		$jsProdfiles = [
			$caravelDir.'bower_components/jquery/dist/jquery.min.js',
			$caravelDir.'public/js/admin/myscript.js'	
		];

		$jsProdDest = $deployDir.'js/admin/script-prod.js';
		$contents = $this->joinFiles($jsProdfiles);
		$this->saveAs($contents, $jsProdDest);
		$this->copyTo($caravelDir.'/bower_components/jquery/dist/jquery.js',
			$deployDir.'js/admin/jquery-devel.js'
		);
		$this->copyTo($caravelDir.'/public/js/admin/myscript.js',
			$deployDir.'js/admin/myscript.js'
		);

		$less = new lessc;
		$less->compileFile($caravelDir.'public/css/admin/style.less',
			$deployDir.'/css/style.css'
		);
		$this->info('style.css updated');
		$this->confirm('Do you want keep watching files for further changes? [y|n] (not implemented)');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			//array('example', InputArgument::REQUIRED, 'An example argument.'),
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

	private function joinFiles($files){
		$content = '';
		foreach($files as $file){
			if(!file_exists($file)){
				die('file '.$file.' does not exist');
			}
			$content .= file_get_contents($file)."\n";
		}
		$this->info('files concatenated');
		return $content;
	}

	private function saveAs($content, $dest){
		$f = fopen($dest, 'w');
		fwrite($f, $content);
		fclose($f);
		$this->info(basename($dest).' saved');
	}

	private function copyTo($src, $dest){
			if(!file_exists($src)){
				die('file '.$src.' does not exist');
			}
			copy($src, $dest);
			$this->info(basename($dest).' copied');

	}

}
