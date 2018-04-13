<?php
/**
 * Add some initial demo content.
 */

namespace Drupal\signage\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;


/**
 * Class InitialContentForm
 *
 * @package Drupal\signage\Form
 */
class InitialContentForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'initial.demo_content';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['create'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Create'),
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $demo = \Drupal::service('signage.content.demo');
    $demo->create();
  }

}
