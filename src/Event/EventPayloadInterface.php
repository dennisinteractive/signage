<?php
/**
 * The event payload interface.
 */

namespace Drupal\signage\Event;

/**
 * Interface EventPayloadInterface.
 *
 * @package Drupal\signage\Event
 */
interface EventPayloadInterface {

  /**
   * Set a data value.
   *
   * @param string $key
   * @param string $value
   *
   * @return self
   */
  public function setValue($key, $value);

  /**
   * Set all the values at once.
   *
   * @param array $array
   *
   * @return self
   */
  public function setValues($array);

  /**
   * Key value pairs.
   *
   * @return array
   */
  public function getValues();

  /**
   * @param $key
   *
   * @return string
   */
  public function getValue($key);

}
