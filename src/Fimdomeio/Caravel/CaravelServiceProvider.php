<?php namespace Fimdomeio\Caravel;

use Illuminate\Support\ServiceProvider;

class CaravelServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		//Call Other service providers
		$this->app->register('Codesleeve\LaravelStapler\LaravelStaplerServiceProvider');
	
		$loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Image', '\Intervention\Image\Facades\Image');

		$this->package('fimdomeio/caravel');
		include __DIR__.'/../../filters.php';
		include __DIR__.'/../../routes.php';
		include __DIR__.'/../../views/macros/form.php';

		$this->app->bind('fimdomeio::commands.build', function($app) {
   			return new BuildCommand();
		});
		$this->commands(array(
  			'fimdomeio::commands.build'
		));

		$this->app->bind('fimdomeio::commands.test', function($app) {
			return new TestCommand();
		});
		$this->commands(array(
  			'fimdomeio::commands.test'
		));

	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
