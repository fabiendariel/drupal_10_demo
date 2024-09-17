<?php

namespace Drupal\Tests\config_pages\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Tests that the ConfigPages UI pages are reachable.
 *
 * @group config_pages
 */
class UiPageTest extends BrowserTestBase {

  /**
   * Modules to enable.
   *
   * @var array
   */
  protected static $modules = ['config_pages'];

  /**
   * {@inheritdoc}
   */
  protected $defaultTheme = 'stable';

  /**
   * Tests that the ConfigPages listing page works.
   */
  public function testConfigPagesPage() {
    $account = $this->drupalCreateUser(['access config_pages overview']);
    $this->drupalLogin($account);

    $this->drupalGet('admin/structure/config_pages');
    $this->assertSession()->statusCodeEquals(200);

    // Test that there is an empty reaction rule listing.
    $this->assertSession()->pageTextContains('There are no config page entities yet.');
  }

  /**
   * Tests that the ConfigPages types listing page works.
   */
  public function testConfigPagesTypesPage() {
    $account = $this->drupalCreateUser(['administer config_pages types']);
    $this->drupalLogin($account);

    $this->drupalGet('admin/structure/config_pages/types');
    $this->assertSession()->statusCodeEquals(200);

    // Test that there is an empty reaction rule listing.
    $this->assertSession()->pageTextContains('There are no config page type entities yet.');
  }

}
