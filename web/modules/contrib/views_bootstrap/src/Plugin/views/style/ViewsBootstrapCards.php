<?php

namespace Drupal\views_bootstrap\Plugin\views\style;

use Drupal\Core\Form\FormStateInterface;
use Drupal\views\Plugin\views\style\StylePluginBase;

/**
 * Style plugin to render each item in an ordered or unordered list.
 *
 * @ingroup views_style_plugins
 *
 * @ViewsStyle(
 *   id = "views_bootstrap_cards",
 *   title = @Translation("Bootstrap Cards"),
 *   help = @Translation("Displays rows in a Bootstrap Card Group layout"),
 *   theme = "views_bootstrap_cards",
 *   theme_file = "../views_bootstrap.theme.inc",
 *   display_types = {"normal"}
 * )
 */
class ViewsBootstrapCards extends StylePluginBase {
  /**
   * Does the style plugin for itself support to add fields to it's output.
   *
   * @var bool
   */
  protected $usesFields = TRUE;

  /**
   * Does the style plugin allows to use style plugins.
   *
   * @var bool
   */
  protected $usesRowPlugin = TRUE;

  /**
   * Overrides \Drupal\views\Plugin\views\style\StylePluginBase::usesRowClass.
   *
   * @var bool
   */
  protected $usesRowClass = TRUE;

  /**
   * Definition.
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    unset($options['grouping']);
    $options['card_title_field'] = ['default' => NULL];
    $options['card_content_field'] = ['default' => NULL];
    $options['card_image_field'] = ['default' => NULL];
    $options['card_group_class_custom'] = ['default' => NULL];
    $options['columns'] = ['default' => NULL];
    return $options;
  }

  /**
   * Render the given style.
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);
    unset($form['grouping']);
    $form['help'] = [
      '#markup' => $this->t('The Bootstrap cards displays content in a flexible container for a lead image with text (<a href=":docs">see documentation</a>).',
        [':docs' => 'https://www.drupal.org/docs/extending-drupal/contributed-modules/contributed-module-documentation/views-bootstrap-for-bootstrap-5/cards']),
      '#weight' => -99,
    ];
    $form['card_title_field'] = [
      '#type' => 'select',
      '#title' => $this->t('Card title field'),
      '#options' => $this->displayHandler->getFieldLabels(TRUE),
      '#required' => TRUE,
      '#default_value' => $this->options['card_title_field'],
      '#description' => $this->t('Select the field that will be used for the card title.'),
      '#weight' => 1,
    ];
    $form['card_content_field'] = [
      '#type' => 'select',
      '#title' => $this->t('Card content field'),
      '#options' => $this->displayHandler->getFieldLabels(TRUE),
      '#required' => TRUE,
      '#default_value' => $this->options['card_content_field'],
      '#description' => $this->t('Select the field that will be used for the card content.'),
      '#weight' => 2,
    ];
    $form['card_image_field'] = [
      '#type' => 'select',
      '#title' => $this->t('Card image field'),
      '#options' => $this->displayHandler->getFieldLabels(TRUE),
      '#required' => TRUE,
      '#default_value' => $this->options['card_image_field'],
      '#description' => $this->t('Select the field that will be used for the card image.'),
      '#weight' => 3,
    ];
    $form['card_group_class_custom'] = [
      '#title' => $this->t('Custom card group class'),
      '#description' => $this->t('Additional classes to provide on the card group. Separated by a space.'),
      '#type' => 'textfield',
      '#default_value' => $this->options['card_group_class_custom'],
      '#weight' => 4,
    ];
    $form['row_class']['#title'] = $this->t('Custom card class');
    $form['row_class']['#weight'] = 5;
    $form['columns'] = [
      '#type' => 'select',
      '#title' => $this->t('Maximum cards per row'),
      '#description' => $this->t('The number of cards to include in a row.'),
      '#options' => [
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 4,
        5 => 5,
        6 => 6,
        7 => 7,
        8 => 8,
        9 => 9,
        10 => 10,
        11 => 11,
        12 => 12,
      ],
      '#default_value' => $this->options['columns'],
      '#weight' => 6,
    ];
  }

}
