<?php

declare(strict_types=1);

/**
 * @file
 * A form to collect data to contact propect.
 */

namespace Drupal\contact_layout\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Provides a 'Contact Layout Form' block.
 *
 * @Block(
 *   id = "contact_layout_form",
 *   admin_label = @Translation("Contact Layout Form"),
 * )
 */
class ContactLayoutFormBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */
  public function build() {
    return \Drupal::formBuilder()->getForm('Drupal\contact_layout\Form\ContactLayoutForm');
  }

  /**
   * {@inheritdoc}
   */
  public function blockAccess(AccountInterface $account) {
    $node = \Drupal::routeMatch()->getParameter('node');

    if (!(is_null($node))) {
      $enabler = \Drupal::service('contact_layout.enabler');
      if ($enabler->isEnabled($node)) {
        return AccessResult::allowedIfHasPermission($account, 'View Contact Layout Form');        
      }
    }
    return AccessResult::forbidden();
  }

}
