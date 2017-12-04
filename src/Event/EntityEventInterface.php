<?php

namespace Drupal\signage\Event;

interface EntityEventInterface {

  const UPDATE = 'signage.entity.update';

  /**
   * @return \Drupal\Core\Entity\EntityInterface
   */
  public function getEntity();

}
