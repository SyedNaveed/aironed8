<?php

namespace Drupal\airchoice_member\Tests;

use Drupal\simpletest\WebTestBase;

/**
 * Provides automated tests for the airchoice_member module.
 */
class DefaultControllerTest extends WebTestBase {


  /**
   * {@inheritdoc}
   */
  public static function getInfo() {
    return [
      'name' => "airchoice_member DefaultController's controller functionality",
      'description' => 'Test Unit for module airchoice_member and controller DefaultController.',
      'group' => 'Other',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function setUp() {
    parent::setUp();
  }

  /**
   * Tests airchoice_member functionality.
   */
  public function testDefaultController() {
    // Check that the basic functions of module airchoice_member.
    $this->assertEquals(TRUE, TRUE, 'Test Unit Generated via Drupal Console.');
  }

}
