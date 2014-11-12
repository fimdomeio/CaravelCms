<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
		Behat\Gherkin\Node\TableNode;
		
use Behat\MinkExtension\Context\MinkContext;

use Fimdomeio\Caravel;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//
		//ADDED BECAUSE DEBUGBAR WAS NOT LOADING
			require_once  __DIR__ .'/../../../../../../vendor/autoload.php';

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
    /**
     * Initializes context.
     * Every scenario gets its own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

		/**
		 * @static
		 * @beforeSuite 
		 */
		public static function bootstrapLaravel(){
			$unitTesting     = true;
			$testEnvironment = 'testing';
			$app             = require_once  __DIR__ .'/../../../../../../bootstrap/start.php';
			$app->boot();
		}


//
// Place your definition and hook methods here:
//
//    /**
//     * @Given /^I have done something with "([^"]*)"$/
//     */
//    public function iHaveDoneSomethingWith($argument)
//    {
//        doSomethingWith($argument);
//    }
//
    /**
     * @Given /^I am Logged in$/
     */
    public function iAmLoggedIn()
    {
        Auth::loginUsingId(1);
    }
}
