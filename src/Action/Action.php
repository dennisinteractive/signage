<?php
namespace Drupal\signage\Action;

class Action implements ActionInterface {

  /**
   * @inheritDoc
   */
  public function getId() {
    // TODO: Implement getId() method.
    return 1;
  }

  /**
   * @inheritDoc
   */
  public function getOutputEventType() {
    // TODO: Implement getOutputEventType() method.
    return 'Drupal\signage\Event\UrlEvent';
  }

  /**
   * @inheritDoc
   */
  public function getFields() {
    // TODO: Implement getFields() method.
    return ['url'];
  }

}
