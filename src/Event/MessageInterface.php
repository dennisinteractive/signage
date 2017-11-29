<?php
/**
 * Message for popups interface.
 */

namespace Drupal\signage\Event;

/**
 * Interface MessageInterface.
 *
 * @package Drupal\signage\Event
 */
interface MessageInterface {

  /**
   * The title of the message.
   * @param $title
   *
   * @return self
   */
  public function setTitle($title);

  /**
   * The title of the message.
   * @return string
   */
  public function getTitle();

  /**
   * The message text.
   * @param $str
   *
   * @return self
   */
  public function setBody($str);

  /**
   * The message text.
   * @return string
   */
  public function getBody();

  /**
   * The type of message success|info|warning|error
   * @param $str
   *
   * @return self
   */
  public function setNotificationType($str);

  /**
   * The type of message.
   * @return string
   */
  public function getNotificationType();

  /**
   * How long in milliseconds to show the message.
   * @param $int
   *
   * @return self
   */
  public function setTimeout($int);

  /**
   * How long in milliseconds to show the message.
   * @return int
   */
  public function getTimeout();

}

