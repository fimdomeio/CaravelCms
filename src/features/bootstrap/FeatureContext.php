<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Laracasts\Behat\Context\Migrator;
use Laracasts\Behat\Context\DatabaseTransactions;

use Illuminate\Contracts\Auth\Registrar;


/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
    use Migrator;
    use DatabaseTransactions;

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
      DB::table('users')->delete();
      DB::table('role_user')->delete();
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
        $registrationAllowed = \App\Setting::where('key', 'allowRegistration')->first();
        if($registrationAllowed->value != 1){
            $registrationAllowed->value = 1;
            $registrationAllowed->save();
        }
       $registrationAllowed = \App\Setting::where('key', 'allowRegistration')->first();
    }

    /**
     * @When I register an account
     */
    public function iRegisterAnAccount()
    {
      $this->visit('auth/register');

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
      $user = \App\User::where('email', $this->email)->first();
      $this->visit('/auth/confirm/'.$user->confirmationString);
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
     * @Given there some registered users
     */
    public function thereSomeRegisteredUsers()
    {
      Artisan::call('db:seed', ['--class' => 'UsersTableSeeder']);
    }
}
