<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Laracasts\Behat\Context\Migrator;
use Laracasts\Behat\Context\DatabaseTransactions;



/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
    use Migrator;
    //use DatabaseTransactions;

    private $baseUrl = '';
    private $name = 'Test User';
    private $email = 'user@example.com';
    private $password = 'testpassword';


    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
      App::environment('behat');
      $this->baseUrl = $this->getMinkParameter('base_url');
    }

    public static function setUpDb()
    {
        Artisan::call('migrate:install');
    }
    
    
    /**
     * @static
     * @beforeFeature
     */
    public static function prepDb()
    {
        Artisan::call('migrate:refresh');
        Artisan::call('db:seed', array('--class' => 'SettingTableSeeder'));
        Artisan::call('db:seed', array('--class' => 'RolesTableSeeder'));
    }

    /**
     * @Given I'm a registered user
     */
    public function iMARegisteredUser()
    {
      $this->iRegisterAnAccount();
      $this->iActivateMyAccount();
    }

    /**
     * @When I login
     */
    public function iLogin()
    {
        $this->visit('auth/login');

        $this->fillField('email', $this->email);
        $this->fillField('password', $this->password);

        $this->pressButton('Login');
    }

    /**
     * @Given Registrations are allowed
     */
    public function registrationsAreAllowed()
    {
      $setting = new App\Setting;
      $setting->key = 'allowRegistration';
      $setting->value = 1;
      $setting->save();
    }

    /**
     * @When I register an account
     */
    public function iRegisterAnAccount()
    {
      $this->visit($this->baseUrl.'/auth/register');

      $this->fillField('name', $this->name);
      $this->fillField('email', $this->email);
      $this->fillField('password', $this->password);
      $this->fillField('password_confirmation', $this->password);
      $this->pressButton('Register');
    }

    public function iActivateMyAccount(){
      $user = \App\User::where('email', $this->email)->first();
      $user->confirmed = true;
      $user->save();
    }

    /**
     * @When I visit the confirmation page
     */
    public function iVisitTheConfirmationPage()
    {
      $users = App\User::get();
      $user = \App\User::where('email', $this->email)->first();

      $this->visit($this->baseUrl.'/auth/confirm/'.$user->confirmationString);
    }

    /**
     * @Then my account should be confirmed
     */
    public function myAccountShouldBeConfirmed()
    {
      $user = \App\User::where('email', $this->email)->first();
      if(!$user->confirmed){
        throw new Exception('Account not Confirmed');
      }
    }

    /**
     * @Then my user should be an :role
     */
    public function myUserShouldBeAn($role)
    {
      $user = \App\User::where('email', $this->email)->with('roles')->first();
      if($user->roles[0]->name != $role){
        throw new Exception('Account not a '.$role);
      }
    }

    /**
     * @Given there are some registered users
     */
    public function thereAreSomeRegisteredUsers()
    {
      Artisan::call('db:seed', ['--class' => 'UsersTableSeeder']);
    }

    /**
     * @AfterStep
     */
    public function takeScreenshotAfterFailedStep(Behat\Behat\Hook\Scope\AfterStepScope $scope)
    {
        if (99 === $scope->getTestResult()->getResultCode()) {
            $this->takeScreenshot();
        }
    }

    private function takeScreenshot()
    {
        $driver = $this->getSession()->getDriver();
        /*if (!$driver instanceof Selenium2Driver) {
            return;
        }*/
        $baseUrl = $this->getMinkParameter('base_url');
        $fileName = date('d-m-y') . '-' . uniqid() . '.png';
        $filePath = '/vagrant/test-results';

        $this->saveScreenshot($fileName, $filePath);
        print 'Saving screenshot at: test-results/'. $fileName;
    }
  
}
