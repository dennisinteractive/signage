<?php
/**
 * The Url output event.
 */

namespace Drupal\signage\Event\Output;

/**
 * Class UrlEvent.
 *
 * @package Drupal\signage\Event
 */
class UrlEvent extends OutputEventAbstract implements OutputEventInterface, UrlEventInterface {

  protected $url;

  /**
   * @inheritDoc
   */
  static public function name() {
    return self::NAME;
  }

  /**
   * @inheritDoc
   */
  public function getUrl() {
    return $this->url;
  }

  /**
   * @inheritDoc
   */
  public function setUrl($url) {
    $this->getPayload()->setValue(0, $url);
    $this->url = $url;
    return $this;
  }

  /**
   * @inheritDoc
   */
  public function populatePayload() {
    // Populate the payload for the output event.

    // Get the payload key value pairs.
    $vals = $this->getAction()->getInputEvent()->getPayload()->getValues();

    // Get the referenced output event of the Action.
    $output_tid = $this->getAction()->getNode()->get('field_signage_do_output_event')->getValue();
    $output_term = \Drupal\taxonomy\Entity\Term::load($output_tid[0]['target_id']);
    // The description field has the content that is to be sent out,
    // but needs values replacing
    $description = $output_term->get('field_signage_output')->getValue();
    $value = trim(strip_tags($description[0]['value']));

    // Replace the placeholders with their values from the payload.
    foreach ($vals as $k => $v) {
      $value = str_replace("[$k]", $v, $value);
    }
    $this->setUrl($value);

    return $this;

  }
}
