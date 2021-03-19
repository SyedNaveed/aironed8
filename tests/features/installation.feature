Feature: Installation
  In order to know that CI worked
  As a website user
  I need to be able to see that the homepage is correct

  Scenario: The homepage site name text is visible.
    Given I am on "/"
    Then I should see "Air Choice One"

  Scenario: The login system is working.
    Given I am not logged in
    When I visit "user/login"
    And I fill in "name" with "test"
    And I fill in "pass" with "test"
    And I press "Log in"
    Then I should see "Unrecognized username or password."

  @api
  Scenario: An authenticated user can access their profile page.
    Given I am logged in as a user with the "authenticated user" role
    When I visit "user"
    Then I should see "Member for"
