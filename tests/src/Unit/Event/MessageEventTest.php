<?php

namespace Drupal\Tests\signage\Unit;


use Drupal\signage\Event\EventPayload;
use Drupal\signage\Event\Message;
use Drupal\signage\Event\MessageEvent;
use Drupal\signage\Event\MessageEventInterface;
use Drupal\signage\Event\MessageInterface;
use Drupal\Tests\UnitTestCase;

/**
 * MessageEventTest
 *
 * @coversDefaultClass Drupal\signage\Event\MessageEvent
 *
 * @group signage_test
 */
class MessageEventTest extends UnitTestCase {

  /**
   * @covers ::name
   */
  public function testName() {
    $message = $this->getMockBuilder(MessageInterface::class)
      ->getMock()
    ;
    $me = new MessageEvent($message);
    $this->assertEquals('signage.message', $me::name());
  }

  /**
   * @covers ::getMessage
   */
  public function testGetMessage() {
    // Populate an event payload.
    $payload = new EventPayload();
    $payload->setValue('title', 'title')
      ->setValue('body', 'body')
      ->setValue('notification_type', 'notification_type')
      ->setValue('time_out', 'time_out');

    $me = new MessageEvent(new Message());
    $me->setPayload($payload);
    $message = $me->getMessage();

    $this->assertInstanceOf(MessageInterface::class, $message);
    $this->assertEquals('title', $message->getTitle());
  }

}
