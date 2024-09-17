<?php

declare(strict_types=1);

/**
 * @file
 * Provide site administrators with a list of all the Contact List submissions
 * so they know who want to be contacted.
 */

namespace Drupal\contact_layout\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class to define the structure of the Contact report
 */
class ReportController extends ControllerBase {

  /**
   * Gets and returns all Contact submissions.
   * These are returned as an associative array, with each row
   * containing the name, email, phone and message of the prospect
   *
   * @return array|null
   */
  protected function load() {
    try {
      $database = \Drupal::database();
      $select_query = $database->select('contact_layout', 'cl');

      // Join the node table, so we can get the page drom which is as write the message
      $select_query->join('node_field_data', 'n', 'cl.nid = n.nid');

      // Select these specific fields for the output
      $select_query->addField('n', 'title');
      $select_query->addField('cl', 'name');
      $select_query->addField('cl', 'email');
      $select_query->addField('cl', 'phone');
      $select_query->addField('cl', 'message');

      $entries = $select_query->execute()->fetchAll(\PDO::FETCH_ASSOC);

      return $entries;
    }
    catch (\Exception $e) {
      \Drupal::messenger()->addStatus(
        $this->t('Unabke to access the database at this time. Please try again later.')
      );
      return NULL;
    }
  }

  /**
   * Create the Contact report page.
   *
   * @return array
   *   Render array for the Contact report
   */
  public function report() {
    $content = [];

    $content['message'] = [
      '#markup' => $this->t('Below is a list of all contact submission including name,
      email, phone and message with the name of the page then send the request in.'),
    ];

    $headers = [
      $this->t('Page'),
      $this->t('Name'),
      $this->t('Email'),
      $this->t('Phone'),
      $this->t('Message'),
    ];

    $table_rows = $this->load();

    $content['table'] = [
      '#type' => 'table',
      '#header' => $headers,
      '#rows' => $table_rows,
      '#empty' => $this->t('No entries available'),
    ];

    // Do not cache this page by setting the max-age to 0.
    $content['#cache']['max-age'] = 0;

    return $content;
  }

}
