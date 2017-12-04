<?php
/**
 * Service for Actions.
 */

namespace Drupal\signage\Service;

use Drupal\node\Entity\Node;
use Drupal\signage\Action\ActionInterface;
use Drupal\signage\Event\InputEvent;

/**
 * Class ActionService.
 *
 * @package Drupal\signage\Service
 */
class ActionService implements ActionServiceInterface {

  /**
   * An empty cloneable action.
   *
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
    $actions = [];

    //@todo Names must be unique for input event terms.

    // Get the tid for the incoming event.
    $event_tids = \Drupal::entityQuery('taxonomy_term')
      ->condition('name', $event->getSource())
      ->execute()
    ;
    if (empty($event_tids)) {
      return $actions;
    }

    $event_tid = reset($event_tids);

    // Get the action content that have the input event tid as a reference.
    $query = \Drupal::entityQuery('node')
      ->condition('field_signage_on_input_event', $event_tid)
    ;
    $rows = $query->execute();

    foreach ($rows as $row) {
      $action = clone $this->action;
      if ($node = Node::load($row)) {
        $action->setNode($node);
        $action->setInputEvent($event);
        $actions[] = $action;
      }
    }

    return $actions;
  }

}
