<?php

namespace Drupal\custom_blocks\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Cache\Cache;

/**
 * Provides a 'Custom Footer' block.
 *
 * @Block(
 *   id = "footer_block",
 *   admin_label = @Translation("Custom Footer"),
 * )
 */
class FooterBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return [
      '#theme' => 'footer_block',
    ];
  }

  /**
  * {@inheritdoc}
  */
  public function getCacheTags() {
    return Cache::mergeTags(parent::getCacheTags(), ["node_list"]);
  }
  
}