<?php
/**
 * The Url output event interface.
 */

namespace Drupal\signage\Event;

/**
 * Interface UrlEventInterface.
 *
 * @package Drupal\signage\Event
 */
interface UrlEventInterface extends OutputEventInterface {

  const NAME = 'signage.url';

  /**
   * The url.
   *
   * @return string
   */
  public function getUrl();

  public function setUrl($url);

}
