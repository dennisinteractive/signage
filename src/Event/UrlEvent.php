<?php
namespace Drupal\signage\Event;


class UrlEvent extends OutputEventAbstract implements OutputEventInterface {

  const NAME = 'signage.url';

  /**
   * @inheritDoc
   */
  static public function name() {
    return self::NAME;
  }

  /**
   * The url.
   * @return string
   */
  public function getUrl() {
    $vals = $this->getPayload()->getValues();
    return reset($vals);
  }

}
