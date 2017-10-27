<?php
namespace Drupal\Signage\Event;

use Symfony\Component\EventDispatcher\Event;

class UrlEvent extends Event implements InputEventInterface {

  const URL = 'signage.url';

  protected $url;

  protected $source;

  public function __construct($url = '') {
    $this->setUrl($url);
  }

  /**
   * @inheritdoc
   */
  public function getSource() {
    return $this->source;
  }

  /**
   * Set the source of the go to url instruction.
   */
  public function setSource($source) {
    $this->source = $source;

    return $this;
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
