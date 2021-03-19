Feature: Manage Flight
  In order to know that the Manage Flight page is operational
  As a website user
  I need to be able to manage my flight

  Scenario: The manage flight page is working.
    Given I am not logged in
    When I visit "manage-flight"
    And I enter "XXXXXX" for "Reservation Number"
    And I enter "Test" for "Last Name"
    And I press "Find Your Flight"
    Then I should see "Reservation not found."
