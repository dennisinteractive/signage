<?php
/**
 * Demo form for sending a message event.
 */

namespace Drupal\signage\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\signage\Event\Input\InputEvent;
use Drupal\signage\Event\Payload\EventPayload;


/**
 * Class DemoMessageInputEventForm.
 *
 * @package Drupal\signage\Form
 */
class DemoMessageInputEventForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'demo_message_input_event';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['title'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('title'),
      '#description' => $this->t('The title of the message'),
      '#size' => 64,
    );

    $form['body'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('message body'),
      '#description' => $this->t('The message'),
      '#size' => 32,
    );
    $form['notification_type'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('notification_type'),
      '#description' => $this->t('success|info|warning|error'),
      '#size' => 32,
    );

    $form['time_out'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('time_out'),
      '#description' => $this->t('Milliseconds to show the message'),
      '#size' => 32,
    );

    $form['dispatch'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Dispatch'),
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $dispatcher = \Drupal::service('event_dispatcher');

    $payload = new EventPayload();
    $payload->setValue('title', $form_state->getValue('title'));
    $payload->setValue('body', $form_state->getValue('body'));
    $payload->setValue('notification_type', $form_state->getValue('notification_type'));
    $payload->setValue('time_out', $form_state->getValue('time_out'));

    $event = new InputEvent('demo.input.message');
    $event->setPayload($payload);
    $dispatcher->dispatch(InputEvent::NAME, $event);
  }
}
