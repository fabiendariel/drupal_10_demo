<?php

namespace Drupal\views_bootstrap\Plugin\views\style;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\style\Table;

/**
 * Style plugin to render each item as a row in a Bootstrap table.
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "views_bootstrap_table",
 *   title = @Translation("Bootstrap Table"),
 *   help = @Translation("Displays rows in a Bootstrap table."),
 *   theme = "views_bootstrap_table",
 *   theme_file = "../views_bootstrap.theme.inc",
 *   display_types = {"normal"}
 * )
 */
class ViewsBootstrapTable extends Table {

  /**
   * Definition.
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    $options['table_class_custom'] = ['default' => NULL];
    $options['responsive'] = ['default' => FALSE];
    $options['bootstrap_styles'] = ['default' => []];

    return $options;
  }

  /**
   * Render the given style.
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $form['help'] = [
      '#markup' => $this->t('The Bootstrap table style adds default Bootstrap table classes and optional classes (<a href=":docs">see documentation</a>).',
        [':docs' => 'https://www.drupal.org/docs/extending-drupal/contributed-modules/contributed-module-documentation/views-bootstrap-for-bootstrap-5/table']),
      '#weight' => -99,
    ];

    $form['table_class_custom'] = [
      '#title' => $this->t('Custom table class'),
      '#description' => $this->t('Additional classes to provide on the table. Separated by a space.'),
      '#type' => 'textfield',
      '#default_value' => $this->options['table_class_custom'],
    ];

    $form['responsive'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Responsive'),
      '#default_value' => $this->options['responsive'],
      '#description' => $this->t('To make a table scroll horizontally on small devices.'),
    ];

    $form['bootstrap_styles'] = [
      '#title' => $this->t('Bootstrap styles'),
      '#type' => 'checkboxes',
      '#default_value' => $this->options['bootstrap_styles'],
      '#options' => [
        'bordered' => $this->t('Bordered'),
        'borderless' => $this->t('Borderless'),
        'sm' => $this->t('Condensed'),
        'hover' => $this->t('Hover'),
        'striped' => $this->t('Striped'),
      ],
    ];
  }

}
