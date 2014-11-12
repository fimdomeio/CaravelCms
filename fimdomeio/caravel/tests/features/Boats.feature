Feature: Boats

	In order to test the CMS
	as a developer
	I wan't to have a boats test Resource

	Background:
		Given there is a test User
		And I am on "/login"
		And I fill in "email" with "test@example.com"
		And I fill in "password" with "testuser"
		And I press "Log in"
		Then I should be on "/admin"
		
	Scenario: I access the boats index page
		Given I have a clean boats table
		And I am on "/boats"
		Then I should not see "Log in to caravel"
		And I should see "There aren't any Boats yet"

	Scenario: I try to add a boat but fail Validation
		Given I am on "/boats"
		When I follow "add Boat"
		And I press "Save"
		Then I should be on "boats/create"
		And I should see "The name field is required."
		And I should see "The build date field is required."



	Scenario: I try to add a boat
		Given I am on "/boats"
		When I follow "add Boat"
		And I fill in "name" with "São Pedro"
		And I fill in "build_date" with "1500-01-01"
		And I fill in "description" with "Going to Brasil!"
		And I press "Save"
		Then I should be on "/boats"
		And I should see "São Pedro"

	Scenario: I try to edit a Boats
		Given I am on "/boats"
		When I follow "edit"
		And I fill in "name" with "Vera Cruz"
		And I press "Save"
		Then I should be on "/boats"
		And I should see "Vera Cruz"

	Scenario: I try to delete a Boat
		Given I am on "/boats"
		When I press "yes"
		Then the response status code should be 200
		And I should see "There aren't any Boats yet"

