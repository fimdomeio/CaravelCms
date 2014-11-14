<?php
//Simple Caravel Install Script
$options = getopt(null, ['no-composer']);
$php = find_command('php');
$composer = find_command('composer');

$appPath = dirname(dirname(dirname(dirname(__FILE__)))).'/app';
$basePath = dirname(dirname(dirname(dirname(__FILE__))));
$caravelPath = dirname(__FILE__);
$configPath = $appPath.'/config/app.php';

if(!isset($options['no-composer'])){
	copy($caravelPath.'/install/composer.json', $basePath.'/composer.json');
	chdir($caravelPath);
	echo "update caravel dependencies\n";
	passthru($composer.' update');
	echo "update base dependencies\n";
	chdir($basePath);
	passthru($composer.' update');
}

$config = file_get_contents($configPath);
if(!(strpos($config,'// § CARAVEL PROVIDER MARKER § //')
	&& strpos($config,'// § CARAVEL FACADE MARKER § //'))){
	echo "\n\nPlease add the following markers to you config file:\n";
	echo $configPath."\n\n";
	echo "after the last provider array line:\n
	// § CARAVEL PROVIDER MARKER § //\n\n";
	echo "after the last Facade array line:\n
	// § CARAVEL FACADE MARKER § //\n\n";

	echo "Then Press Enter to continue";
	//Listen for user input
	$handle = fopen ("php://stdin","r");
	$line = fgets($handle);
	}

//Add to configuration file
addProvider("'Way\Generators\GeneratorsServiceProvider'", $configPath);
addProvider("'Barryvdh\Debugbar\ServiceProvider'", $configPath);
addProvider("'Codesleeve\LaravelStapler\LaravelStaplerServiceProvider'", $configPath);
addProvider("'Fimdomeio\Caravel\CaravelServiceProvider'", $configPath);
addFacade("'Debugbar' => 'Barryvdh\Debugbar\Facade'", $configPath);
addFacade("'Image', '\Intervention\Image\Facades\Image'", $configPath);

if(!file_exists($basePath.'/behat.yml')){
	echo "\n\n Configuring Behat";
	copy($caravelPath.'/install/behat.yml', $basePath.'/behat.yml');
}
recurse_copy($caravelPath.'/install/tests',
	$appPath.'/tests');

if(!file_exists($basePath.'/tests.php')){
	copy($caravelPath.'/install/tests.php',
		$basePath.'/tests.php');
}
if(!file_exists($appPath.'/admin-menu.php')){
	echo "\nadding admin menu\n";
	copy($caravelPath.'/install/admin-menu.php',
		$appPath.'/admin-menu.php');
}
if(!file_exists($appPath.'/menu.php')){
	echo "\nadding normal menu\n";
	copy($caravelPath.'/install/menu.php',
		$appPath.'/menu.php');
}

echo "\nAdding Example Content\n";
recurse_copy($caravelPath.'/install/controllers',
	$appPath.'/controllers');

recurse_copy($caravelPath.'/install/models',
	$appPath.'/models');

recurse_copy($caravelPath.'/install/views',
	$appPath.'/views');

recurse_copy($caravelPath.'/install/migrations',
	$appPath.'/database/migrations');

chdir($basePath);
passthru($php.' artisan dump-autoload');

	echo "\n\nWe're almost done.\n Please configure your DB at app/config/database.php\n";
	echo "Then run 'php artisan migrate' to create the db tables\n";
	echo "\n\n	!!! And we're all set !!!\n";
	echo "run php tests to run the tests";
	echo "just run 'php artisan serve' to run the site";

function addProvider($provider, $configPath){
		$providersMarker = '// § CARAVEL PROVIDER MARKER § //';
		$config = file_get_contents($configPath);
		if(!strpos($config, $provider)){
			$newConfig = str_replace (
				$providersMarker, 
				$providersMarker."\n\t\t".$provider.",", 
				$config);
			echo "added ". $provider. " Service Provider\n";
			file_put_contents($configPath, $newConfig);
		}
}
	
function addFacade($facade, $configPath){
	$facadesMarker = '// § CARAVEL FACADE MARKER § //';
	$config     = file_get_contents($configPath);
	if(!strpos($config, $facade)){
		$newConfig = str_replace (
			$facadesMarker, 
			$facadesMarker."\n\t\t".$facade.",", 
			$config);
		echo "added ". $facade. " FACADE\n";
		file_put_contents($configPath, $newConfig);
	}
}

function find_command ($command) {
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

function recurse_copy($src,$dst) { 
    $dir = opendir($src); 
    @mkdir($dst); 
    while(false !== ( $file = readdir($dir)) ) { 
        if (( $file != '.' ) && ( $file != '..' )) { 
            if ( is_dir($src . '/' . $file) ) { 
                recurse_copy($src . '/' . $file,$dst . '/' . $file); 
            } 
            else { 
                copy($src . '/' . $file,$dst . '/' . $file); 
            } 
        } 
    } 
    closedir($dir); 
} 

