<?php
namespace Drupal\signage\Event;


interface EventPayloadInterface {

  /**
   * Set a data value.
   * @param $key
   * @param $value
   *
   * @return self
   */
  public function setValue($key, $value);

  /**
   * Set all the values at once.
   * @param $array
   *
   * @return self
   */
  public function setValues($array);

  /**
   * Key value pairs.
   * @return array
   */
  public function getValues();

}
