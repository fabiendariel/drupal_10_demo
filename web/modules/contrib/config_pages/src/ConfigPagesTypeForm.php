<?php

namespace Drupal\config_pages;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Path\PathValidatorInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Routing\RouteBuilderInterface;
use Drupal\Core\Messenger\MessengerInterface;

/**
 * Base form for category edit forms.
 */
class ConfigPagesTypeForm extends EntityForm {

  /**
   * Required routes rebuild.
   *
   * @var string
   */
  protected $routesRebuildRequired = FALSE;

  /**
   * Path validator.
   *
   * @var \Drupal\Core\Path\PathValidatorInterface
   */
  protected $pathValidator;

  /**
   * Router builder.
   *
   * @var \Drupal\Core\Routing\RouteBuilderInterface
   */
  protected $routerBuilder;

  /**
   * The Messenger service.
   *
   * @var \Drupal\Core\Messenger\MessengerInterface
   */
  protected $messenger;

  /**
   * Constructs a ConfigPagesForm object.
   *
   * @param \Drupal\Core\Path\PathValidatorInterface $path_validator
   *   The path validator class.
   * @param \Drupal\Core\Routing\RouteBuilderInterface $router_builder
   *   The router interface.
   * @param \Drupal\Core\Messenger\MessengerInterface $messenger
   *   Messenger.
   */
  public function __construct(PathValidatorInterface $path_validator,
                              RouteBuilderInterface $router_builder,
                              MessengerInterface $messenger) {
    $this->pathValidator = $path_validator;
    $this->routerBuilder = $router_builder;
    $this->messenger = $messenger;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('path.validator'),
      $container->get('router.builder'),
      $container->get('messenger')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    /** @var \Drupal\config_pages\ConfigPagesTypeInterface $config_pages_type */
    $config_pages_type = $this->entity;

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => t('Label'),
      '#maxlength' => 255,
      '#default_value' => $config_pages_type->label(),
      '#description' => t("Provide a label for this config page type to help identify it in the administration pages."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $config_pages_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\config_pages\Entity\ConfigPagesType::load',
      ],
      '#maxlength' => EntityTypeInterface::BUNDLE_MAX_LENGTH,
      '#disabled' => !$config_pages_type->isNew(),
    ];

    // Token support.
    $form['token'] = [
      '#type' => 'checkbox',
      '#title' => t('Expose this ConfigPage values as tokens.'),
      '#default_value' => !empty($config_pages_type->token) ? $config_pages_type->token : FALSE,
      '#required' => FALSE,
    ];

    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => t('Save'),
    ];

    $options = [];
    $items = \Drupal::service('plugin.manager.config_pages_context')->getDefinitions();

    foreach ($items as $plugin_id => $item) {
      $options[$plugin_id] = $item['label'];
    }

    // Menu.
    $form['menu'] = [
      '#type' => 'details',
      '#title' => t('Menu'),
      '#tree' => TRUE,
      '#open' => TRUE,
    ];

    $form['menu']['path'] = [
      '#type' => 'textfield',
      '#description' => t('Menu path which will be used for form display.'),
      '#default_value' => !empty($config_pages_type->menu['path'])
        ? $config_pages_type->menu['path']
        : [],
      '#required' => FALSE,
    ];

    $weight = [];
    foreach (range(-50, 50) as $number) {
      $weight[$number] = $number;
    }
    $form['menu']['weight'] = [
      '#type' => 'select',
      '#description' => t('Weight of menu item.'),
      '#options' => $weight,
      '#default_value' => !empty($config_pages_type->menu['weight'])
        ? $config_pages_type->menu['weight']
        : 0,
      '#required' => FALSE,
    ];

    $form['menu']['description'] = [
      '#type' => 'textfield',
      '#description' => t('Description will be displayed under link in Drupal BO.'),
      '#default_value' => !empty($config_pages_type->menu['description'])
        ? $config_pages_type->menu['description']
        : '',
      '#required' => FALSE,
    ];

    // Context.
    $form['context'] = [
      '#type' => 'details',
      '#title' => t('Context'),
      '#tree' => TRUE,
      '#open' => FALSE,
    ];

    $form['context']['show_warning'] = [
      '#type' => 'checkbox',
      '#title' => t('Show context info message on ConfigPage edit form.'),
      '#default_value' => !empty($config_pages_type->context['show_warning'])
        ? $config_pages_type->context['show_warning']
        : TRUE,
      '#required' => FALSE,
    ];

    $default_options = [];
    if (!empty($config_pages_type->context['group'])) {
      foreach ($config_pages_type->context['group'] as $key => $value) {
        if ($value) {
          $default_options[] = $key;
        }
      }
    }
    $form['context']['group'] = [
      '#type' => 'checkboxes',
      '#description' => t('Consider following context for this configuration'),
      '#options' => $options,
      '#default_value' => $default_options,
      '#required' => FALSE,
    ];
    $form['context']['fallback_text'] = [
      '#prefix' => '<h2>',
      '#suffix' => '</h2>',
      '#markup' => $this->t('Fallback for contexts'),
    ];
    foreach ($options as $contextId => $contextLabel) {
      $form['context']['fallback'][$contextId] = [
        '#type' => 'textfield',
        '#title' => $contextLabel,
        '#description' => $this->t('Value that the context is going to have when no config page is found for the current context'),
        '#default_value' => empty($config_pages_type->context['fallback'][$contextId]) ? '' : $config_pages_type->context['fallback'][$contextId],
        '#required' => FALSE,
      ];
    }

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {

    $new_menu_path = $form_state->getValue('menu')['path'];

    if (!empty($new_menu_path) && !in_array($new_menu_path[0], ['/'], TRUE)) {
      $form_state->setErrorByName('menu', $this->t('Manually entered paths should start with /'));
      return;
    }

    $old_menu_path = NULL;

    // Load unchanged entity.
    $config_pages_type = $this->entity;
    $config_pages_type_unchanged = $config_pages_type->load($config_pages_type->id());
    if (is_object($config_pages_type_unchanged)) {
      $old_menu_path = $config_pages_type_unchanged->menu['path'];
    }

    // If menu path was changed check if it's a valid Drupal path.
    if (!empty($new_menu_path) && $new_menu_path != $old_menu_path) {
      $path_exists = $this->pathValidator->isValid($new_menu_path);
      if ($path_exists) {
        $form_state->setErrorByName('menu', $this->t('This menu path already exists, please provide another one.'));
      }
      $this->routesRebuildRequired = TRUE;
    }

  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {

    $config_pages_type = $this->entity;
    $status = $config_pages_type->save();

    $edit_link = $this->entity->toLink($this->t('Edit'), 'edit-form')->toString();
    $logger = $this->logger('config_pages');
    if ($status == SAVED_UPDATED) {
      $this->messenger->addStatus(t('Custom config page type %label has been updated.',
        ['%label' => $config_pages_type->label()]));
      $logger->notice('Custom config page type %label has been updated.',
        ['%label' => $config_pages_type->label(), 'link' => $edit_link]);
    }
    else {
      $this->messenger->addStatus(t('Custom config page type %label has been added.',
        ['%label' => $config_pages_type->label()]));
      $logger->notice('Custom config page type %label has been added.',
        ['%label' => $config_pages_type->label(), 'link' => $edit_link]);
    }

    // Check if we need to rebuild routes.
    if ($this->routesRebuildRequired) {
      $this->routerBuilder->rebuild();
    }

    $form_state->setRedirectUrl($this->entity->toUrl('collection'));
  }

}
