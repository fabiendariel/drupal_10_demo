<?php

namespace Drupal\Tests\field_example\Functional;

/**
 * Functional tests of the 3text widget.
 *
 * Create a content type with a example_field_rgb field, configure it with the
 * field_example_text-widget, create a node and check for correct values.
 *
 * @group field_example
 * @group examples
 */
class Text3WidgetTest extends FieldExampleBrowserTestBase {

  /**
   * Test basic functionality of the example field.
   *
   * - Creates a content type.
   * - Adds a single-valued field_example_rgb to it.
   * - Adds a multivalued field_example_rgb to it.
   * - Creates a node of the new type.
   * - Populates the single-valued field.
   * - Populates the multivalued field with two items.
   * - Tests the result.
   */
  public function testSingleValueField() {
    $assert = $this->assertSession();
    // Add a single field as administrator user.
    $this->drupalLogin($this->administratorAccount);
    $this->fieldName = $this->createField('field_example_rgb', 'field_example_3text', '1');
    // Post-condition: Content type now has the desired field.
    // Switch to the author user to create content with this type and field.
    $this->drupalLogin($this->authorAccount);
    $this->drupalGet('node/add/' . $this->contentTypeName);

    // Fill the create form.
    $title = 'test_title';
    $edit = [
      'title[0][value]' => $title,
      'field_' . $this->fieldName . '[0][value][r]' => '00',
      'field_' . $this->fieldName . '[0][value][g]' => '0a',
      'field_' . $this->fieldName . '[0][value][b]' => '01',
    ];

    // Create the content.
    $this->submitForm($edit, 'Save');
    $assert->pageTextContains("$this->contentTypeName $title has been created");
    // Verify the value is shown when viewing this node.
    $assert->pageTextContains("The color code in this field is #000a01");
  }

  /**
   * Test basic functionality of the example field.
   *
   * - Creates a content type.
   * - Adds a single-valued field_example_rgb to it.
   * - Adds a multivalued field_example_rgb to it.
   * - Creates a node of the new type.
   * - Populates the single-valued field.
   * - Populates the multivalued field with two items.
   * - Tests the result.
   */
  public function testMultiValueField() {
    $assert = $this->assertSession();

    // Add a single field as administrator user.
    $this->drupalLogin($this->administratorAccount);
    $this->fieldName = $this->createField('field_example_rgb', 'field_example_3text', '-1');
    // Post-condition: Content type now has the desired field.
    // Switch to the author user to create content with this type and field.
    $this->drupalLogin($this->authorAccount);
    $this->drupalGet('node/add/' . $this->contentTypeName);

    // Fill the create form.
    $title = $this->randomMachineName(20);
    $edit = [
      'title[0][value]' => $title,
      'field_' . $this->fieldName . '[0][value][r]' => '00',
      'field_' . $this->fieldName . '[0][value][g]' => 'ff',
      'field_' . $this->fieldName . '[0][value][b]' => '00',
    ];

    // Add a 2nd item to the multivalue field, so hit "add another".
    $this->submitForm($edit, 'Add another item');
    $edit = [
      'field_' . $this->fieldName . '[1][value][r]' => 'ff',
      'field_' . $this->fieldName . '[1][value][g]' => 'ff',
      'field_' . $this->fieldName . '[1][value][b]' => 'ff',
    ];

    // Create the content.
    $this->submitForm($edit, 'Save');
    $assert->pageTextContains("$this->contentTypeName $title has been created");
    // Verify the values are shown when viewing this node.
    $assert->pageTextContains('The color code in this field is #00ff00');
    $assert->pageTextContains('The color code in this field is #ffffff');
  }

}
