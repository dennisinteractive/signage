<?php

namespace Drupal\signage\Event\Entity;

use Drupal\Core\Entity\EntityInterface;
use Symfony\Component\EventDispatcher\Event;

class EntityEvent extends Event implements EntityEventInterface {

  /**
   * @var \Drupal\Core\Entity\EntityInterface
   */
  protected $entity;

  /**
   * EntityEvent constructor.
   *
   * @param \Drupal\Core\Entity\EntityInterface $entity
   */
  function __construct(EntityInterface $entity) {
    $this->entity = $entity;
  }

  /**
   * @inheritDoc
   */
  public function getEntity() {
    return $this->entity;
  }

}
