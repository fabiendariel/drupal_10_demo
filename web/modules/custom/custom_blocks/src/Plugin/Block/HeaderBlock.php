<?php

namespace Drupal\custom_blocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;

/**
 * Provides a 'Custom Header' block.
 *
 * @Block(
 *   id = "header_block",
 *   admin_label = @Translation("Custom Header"),
 * )
 */
class HeaderBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#theme' => 'header_block',
    ];
  }

  /**
  * {@inheritdoc}
  */
  public function getCacheTags() {
    return Cache::mergeTags(parent::getCacheTags(), ["node_list"]);
  }
  
}