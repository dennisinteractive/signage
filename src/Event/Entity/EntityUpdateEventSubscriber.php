<?php

namespace Drupal\signage\Event\Entity;

use Drupal\signage\Channel\ChannelChangeEvent;
use Drupal\signage\Device\DeviceInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EntityUpdateEventSubscriber implements EventSubscriberInterface  {

  /**
   * The event dispatcher.
   *
   * @var \Symfony\Component\EventDispatcher\EventDispatcherInterface
   */
  protected $dispatcher;

  /**
   * @var \Drupal\signage\Device\DeviceInterface
   */
  protected $device;

  /**
   * EntityUpdateEventSubscriber constructor.
   *
   * @param \Symfony\Component\EventDispatcher\EventDispatcherInterface $event_dispatcher
   */
  public function __construct(EventDispatcherInterface $event_dispatcher, DeviceInterface $device) {
    $this->dispatcher = $event_dispatcher;
    $this->device = $device;
  }

  /**
   * @inheritDoc
   */
  public static function getSubscribedEvents() {
    $events['signage.entity.update'][] = ['changeChannel', 1];
    return $events;
  }

  /**
   * Handle event: signage.entity.update
   *
   * @param EntityEvent $event
   */
  public function changeChannel(EntityEvent $event) {
    if ($event->getEntity()->bundle() == 'signage_device') {
      $node = $event->getEntity();
      $this->device->setNode($node);
      $channel_change = new ChannelChangeEvent($this->device);
      $this->dispatcher->dispatch($channel_change::NAME, $channel_change);
    }
  }

}
