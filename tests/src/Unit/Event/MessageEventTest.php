<?php

namespace Drupal\Tests\signage\Unit;

use Drupal\signage\Event\Payload\EventPayload;
use Drupal\signage\Event\Payload\EventPayloadInterface;
use Drupal\signage\Event\Output\MessageEvent;
use Drupal\signage\Message\Message;
use Drupal\signage\Message\MessageInterface;
use Drupal\Tests\UnitTestCase;

/**
 * MessageEventTest
 *
 * @coversDefaultClass Drupal\signage\Event\Output\MessageEvent
 *
 * @group signage_test
 */
class MessageEventTest extends UnitTestCase {

  /**
   * @covers ::name
   */
  public function testName() {
    $payload = $this->getMockBuilder(EventPayloadInterface::class)
      ->getMock();
    $message = $this->getMockBuilder(MessageInterface::class)
      ->getMock();
    $me = new MessageEvent($payload, $message);
    $this->assertEquals('signage.message', $me::name());
  }

  /**
   * @covers ::getMessage
   */
  public function DISABLED_testGetMessage() {
    // Populate an event payload.
    $payload = new EventPayload();
    $payload->setValue('title', 'title')
      ->setValue('body', 'body')
      ->setValue('notification_type', 'notification_type')
      ->setValue('time_out', 'time_out');

    $me = new MessageEvent($payload, new Message());
    $message = $me->getMessage();

    $this->assertInstanceOf(MessageInterface::class, $message);
    $this->assertEquals('title', $message->getTitle());
  }

}
