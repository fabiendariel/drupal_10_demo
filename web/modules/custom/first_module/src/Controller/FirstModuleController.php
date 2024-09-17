<?php declare(strict_types = 1);

namespace Drupal\first_module\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for First module routes.
 */
final class FirstModuleController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function __invoke(): array {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

  
  public function simpleContent() {
    $build['content'] = [
      '#type' => 'markup',
      '#markup' => $this->t('Hello Drupal world.'),
    ];

    return $build;
  }

  /**
   * Returns a render array for a test page.
   *
   * @return []
   */
  public function variableContent(string $name_1, string $name_2) {
    $build['content'] = [
      '#type' => 'markup',
      '#markup' => $this->t(
        '@name_1 and @name_2 say hello to you.',
        ['@name_1' => $name_1, '@name_2' => $name_2]
      ),
    ];

    return $build;
  }

  /**
   * Returns a render array for a test page.
   *
   * @return []
   */
  public function clientContentPage() {  
    $build = [
      // Your theme hook name.
      '#theme' => 'client_page',
    ];

    return $build;
  }
  
  /**
   * Returns a render array for a test page.
   *
   * @return []
   */
  public function servicesContentBlock() {  
    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
