<?php
namespace Drupal\signage\Event;


interface UrlEventInterface  {

  const NAME = 'signage.url';

  /**
   * The url.
   * @return string
   */
  public function getUrl();

}
