<?php
namespace Drupal\signage\Event;


interface UrlEventInterface extends OutputEventInterface {

  const NAME = 'signage.url';

  /**
   * The url.
   * @return string
   */
  public function getUrl();

}
