<?php
/**
 * Service for events that are to be dispatched in the future.
 */

namespace Drupal\signage\Event\Pending;

use Drupal\Core\Database\Connection;
use Drupal\Core\Queue\DatabaseQueue;
use Drupal\Core\State\StateInterface;
use Drupal\signage\Event\Output\OutputEventInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class PendingEventService extends DatabaseQueue implements PendingEventServiceInterface {

  /**
   * The database table name.
   */
  const TABLE_NAME = 'signage_pending';

  /**
   * The event dispatcher.
   *
   * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
   */
  protected $dispatcher;

  /**
   * @var \Drupal\Core\State\StateInterface
   */
  protected $state;

  /**
   * Constructs a \Drupal\Core\Queue\DatabaseQueue object.
   *
   * @param \Drupal\Core\Database\Connection $connection
   *   The Connection object containing the key-value tables.
   * @param EventDispatcherInterface $dispatcher
   * @param \Drupal\Core\State\StateInterface $state
   */
  public function __construct(Connection $connection, EventDispatcherInterface $dispatcher, StateInterface $state) {
    parent::__construct('signage_event', $connection);
    $this->dispatcher = $dispatcher;
    $this->state = $state;
  }

  /**
   * @inheritDoc
   */
  public function processQueue() {
    while ($item = $this->claimItem()) {

      $event = $item->data['event'];
      drupal_set_message(
        sprintf(
          'CRON %s for channel: %s with url: %s ',
          $event::name(),
          $event->getChannel()->getName(),
          $event->getUrl()
        )
      );
      
      // Give the channel the state handler, which can't be serialized.
      $event->getChannel()->setState($this->state);
      // Dispatch the event.
      $this->dispatcher->dispatch($event::name(), $event);
      // Remove it from the queue.
      $this->deleteItem($item);
    }
  }

  /**
   * Set the name of the queue to use.
   * @param $name
   *
   * @return $this
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * @inheritDoc
   */
  public function numberDue() {
    try {
      $now = time();
      return $this->connection->query(
        'SELECT COUNT(item_id) 
        FROM {' . static::TABLE_NAME . '} 
        WHERE due <= :now',
        [':now' => $now])
        ->fetchField();
    }
    catch (\Exception $e) {
      $this->catchException($e);
      // If there is no table there cannot be any items.
      return 0;
    }
  }

  /**
   * @inheritDoc
   */
  public function addEvent(OutputEventInterface $event, $due) {
    $data['due'] = $due;
    $data['event'] = $event;

    // Each channel.event has it's own queue.
    $this->setName($event->getChannel()->getId() . '.' . $event::name());
    // Replace existing queue for this channel.event
    $this->deleteQueue();

    // Create the new queue with it's item.
    $this->createItem($data);
  }

  /**
   * {@inheritdoc}
   */
  public function claimItem($lease_time = 30) {
    // Claim an item by updating its expire fields. If claim is not successful
    // another thread may have claimed the item in the meantime. Therefore loop
    // until an item is successfully claimed or we are reasonably sure there
    // are no unclaimed items left.
    while (TRUE) {
      $now = time();
      try {
        $item = $this->connection->queryRange(
          'SELECT data, created, item_id 
          FROM {' . static::TABLE_NAME . '} q 
          WHERE expire = 0
          AND due <= :now
          ORDER BY created, item_id ASC',
          0,
          1,
          [':now' => $now])
          ->fetchObject();
      }
      catch (\Exception $e) {
        $this->catchException($e);
        // If the table does not exist there are no items currently available to
        // claim.
        return FALSE;
      }
      if ($item) {
        // Try to update the item. Only one thread can succeed in UPDATEing the
        // same row. We cannot rely on REQUEST_TIME because items might be
        // claimed by a single consumer which runs longer than 1 second. If we
        // continue to use REQUEST_TIME instead of the current time(), we steal
        // time from the lease, and will tend to reset items before the lease
        // should really expire.
        $update = $this->connection->update(static::TABLE_NAME)
          ->fields([
            'expire' => time() + $lease_time,
          ])
          ->condition('item_id', $item->item_id)
          ->condition('expire', 0);
        // If there are affected rows, this update succeeded.
        if ($update->execute()) {
          $item->data = unserialize($item->data);
          return $item;
        }
      }
      else {
        // No items currently available to claim.
        // No items currently available to claim.
        return FALSE;
      }
    }
  }

  /**
   * Adds a queue item and store it directly to the queue.
   *
   * @param $data
   *   Arbitrary data to be associated with the new task in the queue.
   *
   * @return
   *   A unique ID if the item was successfully created and was (best effort)
   *   added to the queue, otherwise FALSE. We don't guarantee the item was
   *   committed to disk etc, but as far as we know, the item is now in the
   *   queue.
   * @throws \Exception
   */
  protected function doCreateItem($data) {
    if (!isset($data['due'])) {
      $data['due'] = 0;
    }
    $query = $this->connection->insert(static::TABLE_NAME)
      ->fields([
        'name' => $this->name,
        'data' => serialize($data),
        'created' => time(),
        'due' => $data['due'],
      ]);
    // Return the new serial ID, or FALSE on failure.
    return $query->execute();
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
