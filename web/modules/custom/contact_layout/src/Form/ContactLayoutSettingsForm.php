<?php

declare(strict_types=1);

/**
 * @file
 * A form to collect data to contact prospect.
 */

namespace Drupal\contact_layout\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class ContactLayoutSettingsForm extends ConfigFormBase {

  /** 
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'contact_layout.settings';

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'contact_layout_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $types = node_type_get_names();
    $config = $this->config(static::SETTINGS);
    //dd($this->config(static::SETTINGS)->get('allowed_types'));
    $form['contact_layout_types'] = [
      '#type' => 'checkboxes',
      '#title' => $this->t('The content types to enable Contact Layout Form collection for'),
      '#default_value' => $config->get('allowed_types'),
      '#options' => $types,
      '#description' => $this->t('On the specified node types, on Contact Layout Form option 
      will be available and can be enabled while the node is being edited.'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $selected_allowed_types = array_filter($form_state->getValue('contact_layout_types'));
    sort($selected_allowed_types);

    $this->config(static::SETTINGS)
      ->set('allowed_types', $selected_allowed_types)
      ->save();

    parent::submitForm($form, $form_state);
  }

}
