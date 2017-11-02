<?php
namespace Drupal\signage\Event;


class UrlEvent extends OutputEventAbstract implements OutputEventInterface, UrlEventInterface {

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
    $vals = $this->getPayload()->getValues();
    return reset($vals);
  }

}
