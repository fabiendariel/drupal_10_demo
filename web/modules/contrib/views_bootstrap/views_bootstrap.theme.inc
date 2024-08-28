<?php

/**
 * @file
 * Preprocessors and helper functions to make theming easier.
 */

use Drupal\Component\Utility\Html;
use Drupal\Component\Utility\Xss;
use Drupal\Core\Template\Attribute;
use Drupal\views_bootstrap\ViewsBootstrap;

/**
 * Prepares variables for views accordion templates.
 *
 * Default template: views-bootstrap-accordion.html.twig.
 *
 * @param array $vars
 *   An associative array containing:
 *   - view: A ViewExecutable object.
 *   - rows: The raw row data.
 */
function template_preprocess_views_bootstrap_accordion(array &$vars): void {
  $view = $vars['view'];
  $vars['id'] = ViewsBootstrap::getUniqueId($view);
  $group_title_field = isset($view->style_plugin->options['grouping'][0]) ? $view->style_plugin->options['grouping'][0]['field'] : "";
  $panel_title_field = $view->style_plugin->options['panel_title_field'];
  $vars['behavior'] = $view->style_plugin->options['behavior'];
  $vars['collapse'] = $view->style_plugin->options['sections'];
  $vars['attributes']['class'][] = 'accordion';
  if ($view->style_plugin->options['flush']) {
    $vars['attributes']['class'][] = 'accordion-flush';
  }
  if ($panel_title_field) {
    foreach ($vars['rows'] as $id => $row) {
      $vars['group_title'] = $group_title_field ? $view->style_plugin->getField($id, $group_title_field) : "";
      $vars['rows'][$id] = [];
      $vars['rows'][$id]['content'] = $row;
      $vars['rows'][$id]['title'] = [
        '#markup' => Xss::filter($view->style_plugin->getField($id, $panel_title_field), [
          'img',
          'br',
          'h2',
          'h3',
          'h4',
          'h5',
          'h6',
          'span',
          'strong',
          'em',
          'i',
          'small',
        ]),
      ];
    }
  }
  else {
    // @todo This would be better as validation errors on the style plugin options form.
    \Drupal::messenger()->addWarning(t('@style style will not display without the "@field" setting.',
      [
        '@style' => $view->style_plugin->definition['title'],
        '@field' => 'Panel title',
      ]
    ));
  }
  // @todo Make sure that $vars['rows'] is rendered array.
  // @SEE: Have a look template_preprocess_views_view_unformatted()
  // and views-view-unformatted.html.twig
}

/**
 * Prepares variables for views cards templates.
 *
 * Default template: views-bootstrap-cards.html.twig.
 *
 * @param array $vars
 *   An associative array containing:
 *   - view: A ViewExecutable object.
 *   - rows: The raw row data.
 */
function template_preprocess_views_bootstrap_cards(array &$vars): void {
  $view = $vars['view'];
  $vars['id'] = ViewsBootstrap::getUniqueId($view);
  $vars['attributes'] = new Attribute(['class' => ['card-group']]);
  $options = $view->style_plugin->options;
  if ($options['card_group_class_custom']) {
    $option_classes = array_filter(explode(' ', $options['card_group_class_custom']));
    $classes = array_map([Html::class, 'cleanCssIdentifier'], $option_classes);
    $vars['attributes']->addClass($classes);
  }

  $vars['columns'] = $view->style_plugin->options['columns'];

  // Card rows.
  $image = $view->style_plugin->options['card_image_field'];
  $title = $view->style_plugin->options['card_title_field'];
  $content = $view->style_plugin->options['card_content_field'];

  foreach ($vars['rows'] as $id => $row) {
    $vars['rows'][$id] = [];
    $vars['rows'][$id]['image'] = $view->style_plugin->getField($id, $image);
    $vars['rows'][$id]['title'] = $view->style_plugin->getField($id, $title);
    $vars['rows'][$id]['content'] = $view->style_plugin->getField($id, $content);
    $vars['rows'][$id]['attributes'] = new Attribute(['class' => ['card']]);
    if ($row_class = $view->style_plugin->getRowClass($id)) {
      $vars['rows'][$id]['attributes']->addClass($row_class);
    }

  }
}

/**
 * Prepares variables for views carousel template.
 *
 * Default template: views-bootstrap-carousel.html.twig.
 *
 * @param array $vars
 *   An associative array containing:
 *   - view: A ViewExecutable object.
 *   - rows: The raw row data.
 */
function template_preprocess_views_bootstrap_carousel(array &$vars): void {
  $view = $vars['view'];
  $vars['id'] = ViewsBootstrap::getUniqueId($view);
  $vars['attributes']['class'][] = 'views-bootstrap-media-object';
  $vars['attributes']['class'][] = 'media-list';

  // Carousel options.
  $vars['interval'] = $view->style_plugin->options['interval'];
  $vars['navigation'] = $view->style_plugin->options['navigation'];
  $vars['indicators'] = $view->style_plugin->options['indicators'];
  $vars['pause'] = $view->style_plugin->options['pause'] ? 'hover' : FALSE;
  $vars['wrap'] = $view->style_plugin->options['wrap'];
  $vars['effect'] = $view->style_plugin->options['effect'];
  $vars['columns'] = $view->style_plugin->options['columns'];
  $vars['breakpoints'] = $view->style_plugin->options['breakpoints'];
  $vars['use_caption'] = $view->style_plugin->options['use_caption'];
  $vars['ride'] = $view->style_plugin->options['ride'];
  $vars['display'] = 'content';

  // Carousel rows.
  if ($view->style_plugin->options['display'] != 'content' && $view->style_plugin->usesFields()) {
    $image = $view->style_plugin->options['image'];
    $title = $view->style_plugin->options['title'];
    $description = $view->style_plugin->options['description'];
    $fieldLabels = $view->display_handler->getFieldLabels(TRUE);
    $vars['display'] = 'fields';
  }

  foreach ($vars['rows'] as $id => $row) {
    $vars['rows'][$id] = [];
    $row_attributes = ['class' => []];
    $class = $view->style_plugin->options['row_class'];
    if ($vars['display'] == 'fields') {
      $vars['rows'][$id]['image'] = $view->style_plugin->getField($id, $image);
      $vars['rows'][$id]['title'] = $view->style_plugin->getField($id, $title);
      $vars['rows'][$id]['description'] = $view->style_plugin->getField($id, $description);
      // Add any additional fields to result.
      foreach (array_keys($fieldLabels) as $label) {
        if (!in_array($label, [$image, $title, $description])) {
          $vars['rows'][$id][$label] = $view->style_plugin->getField($id, $label);
        }
      }
      $class = strip_tags($view->style_plugin->tokenizeValue($class, $id));
      $class = Html::cleanCssIdentifier($class);
    }
    else {
      $vars['rows'][$id]['content'] = $row;
    }
    $classes = explode(' ', $class);
    foreach ($classes as &$class) {
      $class = Html::cleanCssIdentifier($class);
    }
    $row_class = array_filter($classes);
    if (!empty($row_class)) {
      $row_attributes['class'] = array_merge($row_attributes['class'], $row_class);
    }
    $vars['rows'][$id]['attributes'] = new Attribute($row_attributes);

  }

}

/**
 * Prepares variables for views grid templates.
 *
 * Default template: views-bootstrap-grid.html.twig.
 *
 * @param array $vars
 *   An associative array containing:
 *   - view: A ViewExecutable object.
 *   - rows: The raw row data.
 */
function template_preprocess_views_bootstrap_grid(array &$vars): void {
  $view = $vars['view'];
  $rows = $vars['rows'];
  $vars['id'] = ViewsBootstrap::getUniqueId($view);
  $vars['attributes'] = new Attribute(['class' => 'grid']);
  $options = $view->style_plugin->options;

  if ($options['grid_class']) {
    $grid_class = explode(' ', $options['grid_class']);
    $grid_classes = array_map([Html::class, 'cleanCssIdentifier'], array_filter($grid_class));
    $vars['attributes']->addClass($grid_classes);
  }

  $col_classes = [];
  foreach (ViewsBootstrap::getBreakpoints() as $breakpoint) {
    if ($options["col_$breakpoint"] == 'none') {
      continue;
    }
    $col_classes[] = $options["col_$breakpoint"];
  }
  foreach ($rows as $id => $row) {
    $vars['rows'][$id] = [];
    $vars['rows'][$id]['content'] = $row;
    $vars['rows'][$id]['attributes'] = new Attribute();
    if ($row_class = $view->style_plugin->getRowClass($id)) {
      $vars['rows'][$id]['attributes']->addClass($row_class);
    }
    $vars['rows'][$id]['attributes']->addClass($col_classes);
  }

  $vars['options'] = $options;
}

/**
 * Prepares variables for views list group templates.
 *
 * Default template: views-bootstrap-list-group.html.twig.
 *
 * @param array $vars
 *   An associative array containing:
 *   - view: A ViewExecutable object.
 *   - rows: The raw row data.
 */
function template_preprocess_views_bootstrap_list_group(array &$vars): void {
  $view = $vars['view'];
  $options = $view->style_plugin->options;
  $vars['id'] = ViewsBootstrap::getUniqueId($view);
  $group_title_field = isset($options['grouping'][0]) ? $options['grouping'][0]['field'] : "";
  $vars['attributes'] = new Attribute(['class' => 'views-bootstrap-list-group']);
  if ($options['list_group_class_custom']) {
    $classes = explode(' ', $options['list_group_class_custom']);
    $classes = array_map([Html::class, 'cleanCssIdentifier'], array_filter($classes));
    $vars['attributes']->addClass($classes);
  }
  foreach ($vars['rows'] as $id => $row) {
    $vars['group_title'] = $group_title_field ? $view->style_plugin->getField($id, $group_title_field) : "";
    $vars['rows'][$id] = [];
    $vars['rows'][$id]['content'] = $row;
    $vars['rows'][$id]['title'] = $vars['view']->style_plugin->getField($id, $options['title_field']);
    $vars['rows'][$id]['attributes'] = new Attribute(['class' => ['list-group-item']]);
    if ($row_class = $view->style_plugin->getRowClass($id)) {
      $vars['rows'][$id]['attributes']->addClass($row_class);
    }
  }

}

/**
 * Prepares variables for views media object templates.
 *
 * Default template: views-bootstrap-media-object.html.twig.
 *
 * @param array $vars
 *   An associative array containing:
 *   - view: A ViewExecutable object.
 *   - rows: The raw row data.
 */
function template_preprocess_views_bootstrap_media_object(array &$vars): void {
  $vars['id'] = ViewsBootstrap::getUniqueId($vars['view']);
  $image_field = $vars['view']->style_plugin->options['image_field'];
  $heading_field = $vars['view']->style_plugin->options['heading_field'];
  $body_field = $vars['view']->style_plugin->options['body_field'];
  $alignment = $vars['view']->style_plugin->options['image_class'];
  $image_placement = $vars['view']->style_plugin->options['image_placement'];
  $body_placement = $image_placement == 'first' ? 'last' : 'first';
  $vars['alignment'] = "align-items-{$alignment}";
  $vars['order_image'] = "order-{$image_placement}";
  $vars['order_body'] = "order-{$body_placement}";

  foreach ($vars['rows'] as $id => $row) {
    $vars['rows'][$id] = [];
    $vars['rows'][$id]['image'] = $vars['view']->style_plugin->getField($id, $image_field);
    $vars['rows'][$id]['heading'] = $vars['view']->style_plugin->getField($id, $heading_field);
    $vars['rows'][$id]['body'] = $vars['view']->style_plugin->getField($id, $body_field);
  }
}

/**
 * Prepares variables for views tab templates.
 *
 * Default template: views-bootstrap-tab.html.twig.
 *
 * @param array $vars
 *   An associative array containing:
 *   - view: A ViewExecutable object.
 *   - rows: The raw row data.
 */
function template_preprocess_views_bootstrap_tab(array &$vars): void {
  $vars['id'] = ViewsBootstrap::getUniqueId($vars['view']);
  $view = $vars['view'];
  $group_title_field = isset($view->style_plugin->options['grouping'][0]) ? $view->style_plugin->options['grouping'][0]['field'] : "";
  $tab_field = $view->style_plugin->options['tab_field'];
  $vars['tab_type'] = $view->style_plugin->options['tab_type'];
  $vars['tab_position'] = $view->style_plugin->options['tab_position'];
  $vars['tab_fade'] = $view->style_plugin->options['tab_fade'] ? 'fade' : '';

  // Get tabs.
  if ($tab_field) {
    if (isset($view->field[$tab_field])) {
      foreach (array_keys($vars['rows']) as $key) {
        $vars['tabs'][$key] = [
          '#markup' => Xss::filter($view->style_plugin->getField($key, $tab_field), [
            'img',
            'br',
            'h2',
            'h3',
            'h4',
            'h5',
            'h6',
            'span',
            'strong',
            'em',
            'i',
            'small',
          ]),
        ];
      }
    }
    foreach ($vars['rows'] as $id => $row) {
      $vars['group_title'] = $group_title_field ? $view->style_plugin->getField($id, $group_title_field) : "";
      $vars['rows'][$id] = [];
      $vars['rows'][$id]['content'] = $row;
      $vars['rows'][$id]['attributes'] = new Attribute();
      if ($row_class = $view->style_plugin->getRowClass($id)) {
        $vars['rows'][$id]['attributes']->addClass($row_class);
      }
    }
  }
  else {
    // @todo This would be better as validation errors on the style plugin options form.
    \Drupal::messenger()->addWarning(t('@style style will not display without the "@field" setting.',
      [
        '@style' => $view->style_plugin->definition['title'],
        '@field' => 'Tab title',
      ]
    ));
  }
}

/**
 * Prepares variables for views table templates.
 *
 * Default template: views-bootstrap-table.html.twig.
 *
 * @param array $vars
 *   An associative array containing:
 *   - view: A ViewExecutable object.
 *   - rows: The raw row data.
 */
function template_preprocess_views_bootstrap_table(array &$vars): void {
  $options = $vars['view']->style_plugin->options;
  $vars['attributes'] = new Attribute(['class' => 'table']);
  $vars['responsive'] = $options['responsive'];
  foreach (array_filter($options['bootstrap_styles']) as $style) {
    $vars['attributes']->addClass('table-' . $style);
  }
  if ($options['table_class_custom']) {
    $option_classes = array_filter(explode(' ', $options['table_class_custom']));
    $classes = array_map([Html::class, 'cleanCssIdentifier'], $option_classes);
    $vars['attributes']->addClass($classes);
  }

}
