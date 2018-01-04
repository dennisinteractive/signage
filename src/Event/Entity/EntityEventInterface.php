<?php

namespace Drupal\signage\Event\Entity;

interface EntityEventInterface {

  const UPDATE = 'signage.entity.update';

  /**
   * @return \Drupal\Core\Entity\EntityInterface
   */
  public function getEntity();

}
