Feature: Authorizations
	In order to access the site administration area
	as a site registered user
	I need to be able to register and login to my account

Scenario: Register first user
	Given Registrations are allowed
	When I register an account
	Then I should see "Please check your e-mail"
	When I visit the confirmation page
	Then my account should be confirmed
	Then my user should be an "admin"


Scenario: Register second user
	Given registrations are allowed
	Given there some registered users  
	When I register an account
	Then I should see "Please check your e-mail"
	When I visit the confirmation page
	Then my account should be confirmed
	Then my user should be an "editor"

Scenario: Register without confirmation Password
	Given Registrations are allowed
	When I go to "/auth/register"
	When I fill in "email" with "someemail@example.com"
	When I fill in "password" with "someuniquepassword"
	When I fill in "password_confirmation" with "someotherpassword"
	When I press "Register"
	Then I should see "The password confirmation does not match" 

Scenario: Login
	Given I'm a registered user
	When I login
	Then I should be on "/admin"

