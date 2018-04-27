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
    $form['body'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('keys & values json'),
      '#description' => $this->t('keys that are used in the Demo message output term. 
      for example: {"Site": "FakeSite","FOO":"is not bar","BAR":"is notFoo"} '),
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
    $vals = json_decode($form_state->getValue('body'));
    $payload = new EventPayload();
    $payload->setValues($vals);

    $event = new InputEvent('demo.input.message');
    $event->setPayload($payload);
    $dispatcher->dispatch(InputEvent::NAME, $event);
  }
}
