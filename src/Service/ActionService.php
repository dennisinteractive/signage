<?php
namespace Drupal\signage\Service;

use Drupal\signage\Action\ActionInterface;
use Drupal\signage\Event\InputEvent;

class ActionService implements ActionServiceInterface {

  /**
   * @var \Drupal\signage\Action\ActionInterface
   */
  protected $action;

  /**
   * ActionService constructor.
   *
   * @param \Drupal\signage\Action\ActionInterface $action
   */
  public function __construct(ActionInterface $action) {
    $this->action = $action;
  }

  /**
   * @inheritDoc
   */
  public function getActionsForInputEvent(InputEvent $event) {
    // TODO: Implement getActionIdsForSource() method.

    // For multiple actions; clone $this->action
    $action = clone $this->action;
    $action->setInputEvent($event);
    return [$action];
  }

}
