<?php
namespace Drupal\signage\Event;

use Symfony\Component\EventDispatcher\Event;

class UrlEvent extends Event {

  const URL = 'signage.url';

  protected $url;

  public function __construct($url = '') {
    $this->setUrl($url);
  }

  /**
   * The url the client should visit.
   * @param $url string
   * @return self
   */
  public function setUrl($url) {
    $this->url = $url;

    return $this;
  }

  /**
   * The url.
   * @return string
   */
  public function getUrl() {
    return $this->url;
  }

}
