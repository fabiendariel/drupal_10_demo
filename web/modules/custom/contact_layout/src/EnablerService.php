<?php

declare(strict_types=1);

/**
 * @file
 * Contains the Contact Layout Enabler service.
 */

namespace Drupal\contact_layout;

use Drupal\Core\Database\Connection;
use Drupal\node\Entity\Node;

/**
 * Class to define the structure of the Contact Layout enabler service.
 */
class EnablerService {

  protected $database_connection;

  public function __construct(Connection $connection) {
    $this->database_connection = $connection;
  }

  /**
   * Checks if an individual node is Contact Layout enabled.
   *
   * @param Node $node
   *
   * @return bool
   *   whether or not the node is enabled for Contact Layout functionality
   */
  public function isEnabled(Node $node) {
    if ($node->isNew()) {
      return FALSE;
    }
    try {
      $select = $this->database_connection->select('contact_layout_enabled', 'cle');
      $select->fields('cle', ['nid']);
      $select->condition('nid', $node->id());
      $results = $select->execute();

      return !(empty($results->fetchCol()));
    }
    catch (\Exception $e) {
      \Drupal::messenger()->addError(
        $this->t('Unable to determine Contact Layout settings at this time. Please try again.')
      );
      return NULL;
    }
  }

  /**
   * Sets an individual node to be Contact Layout enabled.
   *
   * @param Node $node
   *
   * @throws Exception
   */
  public function setEnabled(Node $node) {
    try {
      if (!($this->isEnabled($node))) {
        $insert = $this->database_connection->insert('contact_layout_enabled');
        $insert->fields(['nid']);
        $insert->values([$node->id()]);
        $insert->execute();
      }
    }
    catch (\Exception $e) {
      \Drupal::messenger()->addError(
        $this->t('Unable to save Contact Layout settings at this time. Please try again.')
      );
      return NULL;
    }
  }

  /**
   * Deletes Contact Layout enabled settings for an individual node.
   *
   * @param Node $node
   */
  public function delEnabled(Node $node) {
    try {
      $delete = $this->database_connection->delete('contact_layout_enabled');
      $delete->condition('nid', $node->id());
      $delete->execute();
    }
    catch (\Exception $e) {
      \Drupal::messenger()->addError(
        $this->t('Unable to save Contact Layout settings at this time. Please try again.')
      );
      return NULL;
    }
  }

}
