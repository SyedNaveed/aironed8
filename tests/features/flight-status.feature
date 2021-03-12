Feature: Flight Status
  In order to know that the Flight Status page is operational
  As a website user
  I need to be able to see my flight status

  Scenario: The flight status page is working.
    Given I am not logged in
    When I visit "flight-status"
    And I press "Find Your Flight"
    Then I should see "Flight #"
