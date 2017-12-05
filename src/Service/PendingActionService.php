<?php
/**
 * Service for Pending actions.
 */

namespace Drupal\signage\Service;

use Drupal\Core\Queue\DatabaseQueue;
use Drupal\signage\Action\ActionInterface;

class PendingActionService extends DatabaseQueue implements PendingActionServiceInterface {

  /**
   * The database table name.
   */
  const TABLE_NAME = 'actions_pending';

  /**
   * @inheritDoc
   */
  public function numberOfDueActions() {
    // TODO: Implement numberOfDueActions() method.
  }

  /**
   * @inheritDoc
   */
  public function getDueAction() {
    // TODO: Implement getDueAction() method.
  }

  /**
   * @inheritDoc
   */
  public function addAction(ActionInterface $action) {
    // TODO: Implement addAction() method.

    $data['id'] = $action->getId();
    $this->createItem($data);
  }

  /**
   * @inheritDoc
   */
  public function deleteAction(ActionInterface $action) {
    // TODO: Implement deleteAction() method.
  }


  /**
   * Defines the schema for the queue table.
   */
  public function schemaDefinition() {
    return [
      'description' => 'Stores actions in the queue.',
      'fields' => [
        'item_id' => [
          'type' => 'serial',
          'unsigned' => TRUE,
          'not null' => TRUE,
          'description' => 'Primary Key: Unique item ID.',
        ],
        'name' => [
          'type' => 'varchar_ascii',
          'length' => 255,
          'not null' => TRUE,
          'default' => '',
          'description' => 'The queue name.',
        ],
        'data' => [
          'type' => 'blob',
          'not null' => FALSE,
          'size' => 'big',
          'serialize' => TRUE,
          'description' => 'The arbitrary data for the item.',
        ],
        'expire' => [
          'type' => 'int',
          'not null' => TRUE,
          'default' => 0,
          'description' => 'Timestamp when the claim lease expires on the item.',
        ],
        'due' => [
          'type' => 'int',
          'not null' => TRUE,
          'default' => 0,
          'description' => 'Timestamp when the action is ready for dispatch.',
        ],
        'created' => [
          'type' => 'int',
          'not null' => TRUE,
          'default' => 0,
          'description' => 'Timestamp when the item was created.',
        ],
      ],
      'primary key' => ['item_id'],
      'indexes' => [
        'name_created' => ['name', 'created'],
        'expire' => ['expire'],
      ],
    ];
  }

}
