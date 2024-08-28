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
 *   id = "views_bootstrap_tab",
 *   title = @Translation("Bootstrap Tabs"),
 *   help = @Translation("Displays rows in Bootstrap Tabs."),
 *   theme = "views_bootstrap_tab",
 *   theme_file = "../views_bootstrap.theme.inc",
 *   display_types = {"normal"}
 * )
 */
class ViewsBootstrapTab extends StylePluginBase {

  /**
   * Does the style plugin for itself support to add fields to it's output.
   *
   * @var bool
   */
  protected $usesFields = TRUE;

  /**
   * {@inheritdoc}
   */
  protected $usesOptions = TRUE;

  /**
   * {@inheritdoc}
   */
  protected $usesRowPlugin = TRUE;

  /**
   * Definition.
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    $options['tab_field'] = ['default' => ''];
    $options['tab_type'] = ['default' => 'tabs'];
    $options['tab_position'] = ['default' => 'basic'];
    $options['tab_fade'] = ['default' => FALSE];
    return $options;
  }

  /**
   * {@inheritdoc}
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);

    $form['help'] = [
      '#markup' => $this->t('The Bootstrap tabs displays content with tab titles linked to dynamically displayed content (<a href=":docs">see documentation</a>).', [':docs' => 'https://www.drupal.org/docs/extending-drupal/contributed-modules/contributed-module-documentation/views-bootstrap-for-bootstrap-5/tabs']),
      '#weight' => -99,
    ];

    $form['tab_field'] = [
      '#type' => 'select',
      '#title' => $this->t('Tab field'),
      '#options' => $this->displayHandler->getFieldLabels(TRUE),
      '#required' => TRUE,
      '#default_value' => $this->options['tab_field'],
      '#description' => $this->t('Select the field that will be used as the tab.'),
    ];

    $form['tab_type'] = [
      '#type' => 'select',
      '#title' => $this->t('Tab Type'),
      '#options' => [
        'tabs' => $this->t('Tabs'),
        'pills' => $this->t('Pills'),
        'list' => $this->t('List'),
      ],
      '#required' => TRUE,
      '#default_value' => $this->options['tab_type'],
    ];

    $form['tab_position'] = [
      '#type' => 'radios',
      '#title' => $this->t('Position of tabs'),
      '#options' => [
        'basic' => $this->t('Tabs/pills on the top'),
        'left' => $this->t('Tabs/pills on the left'),
        'right' => $this->t('Tabs/pills on the right'),
        'below' => $this->t('Tabs/pills on the bottom'),
        'justified' => $this->t('Tabs/pills justified on the top'),
        'stacked' => $this->t('Tabs/pills stacked'),
      ],
      '#required' => TRUE,
      '#default_value' => $this->options['tab_position'] ?? 'basic',
    ];

    $form['tab_fade'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Fade Effect'),
      '#default_value' => $this->options['tab_fade'],
      '#description' => $this->t('Add a fade in effect when tabs clicked'),
    ];
  }

}
