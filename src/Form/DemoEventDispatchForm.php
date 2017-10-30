<?php


namespace Drupal\signage\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\signage\Event\InputEvent;
use Drupal\signage\Event\EventPayload;
use Drupal\signage\Event\UrlEvent;
use Drupal\signage\Event\MessageEvent;

/**
 * Class DemoEventDispatchForm.
 *
 * @package Drupal\signage\Form
 */
class DemoEventDispatchForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'demo_event_dispatch_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['url'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Url'),
      '#description' => $this->t('The url for the event'),
      '#size' => 64,
    );

    $form['key_1'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Key 1'),
      '#description' => $this->t('The key for value Value 1'),
      '#size' => 32,
    );
    $form['value_1'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Value 1'),
      '#description' => $this->t('The value of Key 1'),
      '#size' => 32,
    );

    $form['key_2'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Key 2'),
      '#description' => $this->t('The key for value Value 2'),
      '#size' => 32,
    );
    $form['value_2'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Value 1'),
      '#description' => $this->t('The value of Key 2'),
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
    $payload->setValue('url', $form_state->getValue('url'));
    $payload->setValue('key_1', $form_state->getValue('key_1'));
    $payload->setValue('value_1', $form_state->getValue('value_1'));
    $payload->setValue('key_2', $form_state->getValue('key_2'));
    $payload->setValue('value_2', $form_state->getValue('value_2'));

    $event = new InputEvent('Demo', 'demo.input');
    $event->setPayload($payload);
    $dispatcher->dispatch(InputEvent::NAME, $event);
  }
}
