<?php

declare(strict_types=1);

/**
 * @file
 * A form to collect data to contact propect.
 */

namespace Drupal\contact_layout\Form;

use Drupal\Component\Utility\EmailValidator;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Language\LanguageManagerInterface;
use Drupal\Core\Mail\MailManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Contact form implementation.
 *
 * @ingroup contact_form_group
 */
class ContactLayoutForm extends FormBase {

  /**
   * The mail manager.
   *
   * @var \Drupal\Core\Mail\MailManagerInterface
   */
  protected $mailManager;

  /**
   * The email validator.
   *
   * @var \Drupal\Component\Utility\EmailValidator
   */
  protected $emailValidator;

  /**
   * The language manager.
   *
   * @var \Drupal\Core\Language\LanguageManagerInterface
   */
  protected $languageManager;

  /**
   * Constructs a new EmailExampleGetFormPage.
   *
   * @param \Drupal\Core\Mail\MailManagerInterface $mail_manager
   *   The mail manager.
   * @param \Drupal\Core\Language\LanguageManagerInterface $language_manager
   *   The language manager.
   * @param \Drupal\Component\Utility\EmailValidator $email_validator
   *   The email validator.
   */
  public function __construct(MailManagerInterface $mail_manager, LanguageManagerInterface $language_manager, EmailValidator $email_validator) {
    $this->mailManager = $mail_manager;
    $this->languageManager = $language_manager;
    $this->emailValidator = $email_validator;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    $form = new static(
      $container->get('plugin.manager.mail'),
      $container->get('language_manager'),
      $container->get('email.validator')
    );
    $form->setMessenger($container->get('messenger'));
    $form->setStringTranslation($container->get('string_translation'));
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'contact_layout_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Attemps to get the fully loaded node object of the viewed page.
    $node = FormBase::getRouteMatch()->getParameter('node');

    // If a node was loaded, get the node id.
    if (!(is_null($node))) {
      $nid = $node->id();
    }
    else {
      // If a node could not be loaded, default to 0.
      $nid = 0;
    }
    //dd($nid);

    // Establish the form to get in contact with the team.
    // It need you name and email, your phone and message.
    // It also has a submit button and an hidden filed containing the node ID.
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#size' => 25,
      '#attributes' => ['placeholder' => $this->t('Your Name *')],
      '#required' => TRUE,
      '#title_display' => 'invisible',
    ];

    $form['email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Email'),
      '#size' => 25,
      '#attributes' => ['placeholder' => $this->t('Your Email *')],
      '#required' => TRUE,
      '#title_display' => 'invisible',
    ];

    $form['phone'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Phone'),
      '#minlength' => 10,
      '#maxlength' => 12,
      '#size' => 12,
      '#attributes' => ['placeholder' => $this->t('Your Phone (XXX-XXX-XXXX)')],
      '#required' => FALSE,
      '#title_display' => 'invisible',
    ];

    $form['message'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Message'),
      '#size' => 255,
      '#attributes' => ['placeholder' => $this->t('Your Message')],
      '#required' => FALSE,
      '#title_display' => 'invisible',
    ];

    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('SEND MESSAGE'),
      '#attributes' => ['class' => ['btn-xl', 'text-uppercase']],
    ];

    $form['nid'] = [
      '#type' => 'hidden',
      '#value' => $nid,
    ];

    $form['#theme'] = 'contact_layout_form';
    // \Drupal::messenger()->addStatus(t('Successful message.'));
    // \Drupal::messenger()->addWarning(t('Warning message.'));
    // \Drupal::messenger()->addError(t('Error message.'));
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    if ($form_state->getValue('phone') !== '' &&
    !preg_match('/^(\(\+[0-9]{2}\))?([0-9]{3}[\s\-]?)?([0-9]{3})[\s\-]?([0-9]{4})(\/[0-9]{4})?$/m', $form_state->getValue('phone'))) {
      $form_state->setErrorByName('phone', $this->t('The phone number is invalid. Please enter a full canadian phone number.'));
    }

    if (!$this->emailValidator->isValid($form_state->getValue('email'))) {
      $form_state->setErrorByName('email', $this->t('That email address is not valid.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $form_values = $form_state->getValues();

    try {
      $current_time = \Drupal::time()->getRequestTime();
      $query = \Drupal::database()->insert('contact_layout');
      $query->fields([
        'nid',
        'name',
        'email',
        'phone',
        'message',
        'created',
      ]);
      $query->values([
        $form_values['nid'],
        $form_values['name'],
        $form_values['email'],
        $form_values['phone'],
        $form_values['message'],
        $current_time,
      ]);

      $query->execute();

      $this->messenger()->addStatus(
        $this->t('Your message has been saved. We will be in touch as soon as possible.')
      );
    }
    catch (\Exception $e) {
      $this->messenger()->addError(
        $this->t('Unable to save your message. Please try again. @e', ['@e' => $e]) 
      );
    }

    // All system mails need to specify the module and template key (mirrored
    // from hook_mail()) that the message they want to send comes from.
    $module = 'contact_layout';
    $key = 'contact_message';

    // Specify 'to' and 'from' addresses.
    $from = $form_values['email'];
    $to = $this->config('system.site')->get('mail');

    // "params" loads in additional context for email content completion in
    // hook_mail(). In this case, we want to pass in the values the user entered
    // into the form, which include the message body in $form_values['message'].
    $params = $form_values;

    // The language of the email. This will one of three values:
    // - $account->getPreferredLangcode(): Used for sending mail to a particular
    //   website user, so that the mail appears in their preferred language.
    // - \Drupal::currentUser()->getPreferredLangcode(): Used when sending a
    //   mail back to the user currently viewing the site. This will send it in
    //   the language they're currently using.
    // - \Drupal::languageManager()->getDefaultLanguage()->getId: Used when
    //   sending mail to a pre-existing, 'neutral' address, such as the system
    //   email address, or when you're unsure of the language preferences of
    //   the intended recipient.
    //
    // Since in our case, we are sending a message to a random email address
    // that is not necessarily tied to a user account, we will use the site's
    // default language.
    $language_code = $this->languageManager->getDefaultLanguage()->getId();

    // Whether or not to automatically send the mail when we call mail() on the
    // mail manager. This defaults to TRUE, and is normally what you want unless
    // you need to do additional processing before the mail manager sends the
    // message.
    $send_now = TRUE;
    // Send the mail, and check for success. Note that this does not guarantee
    // message delivery; only that there were no PHP-related issues encountered
    // while sending.
    /*
     * $result = $this->mailManager->mail(
     *   $module, $key, $to, $language_code, $params, $from, $send_now
     * );
     *
     * if ($result['result'] == TRUE) {
     *   $this->messenger()->addMessage(
     *     $this->t('Your message has been sent.')
     *   );
     * }
     * else {
     *   $this->messenger()->addMessage(
     *     $this->t('There was a problem sending your message and it was not sent.'),
     *   'error');
     * }
     */

  }

}
