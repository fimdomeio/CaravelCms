Feature: Boats

	In order to test the CMS
	as a developer
	I wan't to have a boats test Resource

	Scenario: I access the boats index page
		Given I am on "/boats"
		Then the response status code should be 200
		And I should see "Boats"
		And I should see "name"
		And I should see "add Boat"
		And I should see "There aren't any Boats yet"
