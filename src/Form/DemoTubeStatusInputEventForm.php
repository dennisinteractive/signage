<?php
/**
 * Demo form for sending a tube status event.
 */

namespace Drupal\signage\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\signage\Event\InputEvent;
use Drupal\signage\Event\EventPayload;


/**
 * Class DemoTubeStatusInputEventForm.
 *
 * @package Drupal\signage\Form
 */
class DemoTubeStatusInputEventForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'demo_tube_input_event';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
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
    $event = new InputEvent('signage.input.tube');
    $event->setPayload($payload);
    $dispatcher->dispatch(InputEvent::NAME, $event);
  }
}
