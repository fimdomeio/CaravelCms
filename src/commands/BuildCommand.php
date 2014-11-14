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
	protected $name = 'caravel:build';

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
		$this->description = 'Renders less concatenates and moves js.';

		$this->deployDir = base_path()."/public/packages/fimdomeio/caravel/";
		$this->caravelDir = base_path().'/workbench/fimdomeio/caravel/';
			
		$this->jsProdSrc = [
				[
					'path' => $this->caravelDir.'bower_components/jquery/dist/jquery.min.js',
					'mtime' => filemtime($this->caravelDir.'bower_components/jquery/dist/jquery.min.js')
				],
				[
					'path' => $this->caravelDir.'bower_components/bootstrap/dist/js/bootstrap.min.js',
					'mtime' => filemtime($this->caravelDir.'bower_components/bootstrap/dist/js/bootstrap.min.js')
				],

				[
					'path' => $this->caravelDir.'bower_components/angular/angular.min.js',
					'mtime' => filemtime($this->caravelDir.'bower_components/angular/angular.min.js')
				],
				[
					'path' => $this->caravelDir.'bower_components/angular-animate/angular-animate.min.js',
					'mtime' => filemtime($this->caravelDir.'bower_components/angular-animate/angular-animate.min.js')
				],
				[
					'path' => $this->caravelDir.'public/js/admin/myscript.js',
					'mtime' => filemtime($this->caravelDir.'public/js/admin/myscript.js')
				]
			];

		$this->jsProdDest = $this->deployDir.'js/admin/script-prod.js';

		$this->jsDevelSrc = [
				'jquery' => [
					'path' => $this->caravelDir.'bower_components/jquery/dist/jquery.js',
					'mtime' => filemtime($this->caravelDir.'bower_components/jquery/dist/jquery.js')
				],
				'bootstrap' => [
					'path' => $this->caravelDir.'bower_components/bootstrap/dist/js/bootstrap.js',
					'mtime' => filemtime($this->caravelDir.'bower_components/bootstrap/dist/js/bootstrap.js')
				],

				'angular' => [
					'path' => $this->caravelDir.'bower_components/angular/angular.js',
					'mtime' => filemtime($this->caravelDir.'bower_components/angular/angular.js')
				],
				'angularAnimate' => [
					'path' => $this->caravelDir.'bower_components/angular-animate/angular-animate.js',
					'mtime' => filemtime($this->caravelDir.'bower_components/angular-animate/angular-animate.js')
				],
				'myscript' => [
					'path' => $this->caravelDir.'public/js/admin/myscript.js',
					'mtime' => filemtime($this->caravelDir.'public/js/admin/myscript.js')
				]
			];

		$this->jsDevelDest = [
			'jquery' => $this->deployDir.'js/admin/jquery-devel.js',
			'bootstrap' => $this->deployDir.'js/admin/bootstrap-devel.js',
			'angular' => $this->deployDir.'js/admin/angular-devel.js',
			'angularAnimate' => $this->deployDir.'js/admin/angular-animate-devel.js',
			'myscript' => $this->deployDir.'js/admin/myscript.js'			
		];

		$this->lessSrc = [
				'style' => [
					'path' => $this->caravelDir.'public/css/admin/style.less',
					'mtime' => filemtime($this->caravelDir.'public/css/admin/style.less')
				]
			];

		$this->lessc = $this->find_command('lessc');
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		if($this->lessc){
			$this->info('lessc Found. Will be used to speed up css generation.');
		}else{
			$this->info('lessc Not Found. Will compile css with php lib (slower).'); 
		
		}

		// Create folders if they don't exist
		if(!file_exists($this->deployDir.'js/admin/')){
			mkdir($this->deployDir.'js/admin/', 0755, true);
		}
		if(!file_exists($this->deployDir.'css/admin/')){
			mkdir($this->deployDir.'css/admin/', 0755, true);
		}

		$this->update();
		$this->info('-----------------------------');
		$this->info("     Now watching for file changes on less and js files inside caravel.\n     Use ctrl+c to quit");
		$this->info('-----------------------------');
		while(true){
			sleep(1);
			clearstatcache(); //clear file mtimes cache
			if($this->updateMtime($this->jsDevelSrc) ||
				$this->updateMtime($this->jsProdSrc) ||
				$this->updateMtime($this->lessSrc)
			){
				$this->update();
			}
		}
	}

	private function updateMtime(&$fileGroup){
			foreach($fileGroup as &$file){
				$oldMtime = $file['mtime'];
				$file['mtime'] = filemtime($file['path']);
				if($oldMtime != $file['mtime']){
					$this->info("-----\n".basename($file['path'])." changed at ".date('H:i:s', time()) ."\n-----");
					return true;
				}
			}
			return false;
	}

	private function update(){
		$contents = $this->joinFiles($this->jsProdSrc);
		$this->saveAs($contents, $this->jsProdDest);

		$this->copyTo($this->jsDevelSrc['jquery']['path'], $this->jsDevelDest['jquery']);
		$this->copyTo($this->jsDevelSrc['bootstrap']['path'], $this->jsDevelDest['bootstrap']);
		$this->copyTo($this->jsDevelSrc['angular']['path'], $this->jsDevelDest['angular']);
		$this->copyTo($this->jsDevelSrc['angularAnimate']['path'], $this->jsDevelDest['angularAnimate']);
		$this->copyTo($this->jsDevelSrc['myscript']['path'], $this->jsDevelDest['myscript']);
		
		if($this->lessc){
			$cmd = $this->lessc." \"".$this->lessSrc['style']['path']."\" \"".$this->deployDir."css/admin/style.css"."\"";
			passthru($cmd);
		}else{
			$less = new lessc;
			$less->compileFile($this->lessSrc['style']['path'],
				$this->deployDir.'css/admin/style.css'
			);
		}
		$this->info('style.css updated');
		echo "\x07"; //system beep
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
			if(!file_exists($file['path'])){
				die('file '.$file['path'].' does not exist');
			}
			$content .= file_get_contents($file['path'])."\n";
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

	//Searches if command exists on system
	private function find_command ($command) {
		$whereIsCommand = (PHP_OS == 'WINNT') ? 'where' : 'which';

		$process = proc_open(
			"$whereIsCommand $command",
			array(
				0 => array("pipe", "r"), //STDIN
				1 => array("pipe", "w"), //STDOUT
				2 => array("pipe", "w"), //STDERR
			),
			$pipes
		);
		if ($process !== false) {
			$stdout = stream_get_contents($pipes[1]);
			$stderr = stream_get_contents($pipes[2]);
			fclose($pipes[1]);
			fclose($pipes[2]);
			proc_close($process);

			return trim($stdout);
		}

		return false;
	}

	
}
