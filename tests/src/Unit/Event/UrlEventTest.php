<?php

namespace Drupal\Tests\signage\Unit;


use Drupal\signage\Event\Output\UrlEvent;
use Drupal\signage\Event\Payload\EventPayload;
use Drupal\signage\Event\Payload\EventPayloadInterface;
use Drupal\Tests\UnitTestCase;

/**
 * UrlEventTest
 *
 * @coversDefaultClass Drupal\signage\Event\Output\UrlEvent
 *
 * @group signage_test
 */
class UrlEventTest extends UnitTestCase {

  /**
   * @covers ::name
   */
  public function testName() {
    $payload = $this->getMockBuilder(EventPayloadInterface::class)
      ->getMock();
    $e = new UrlEvent($payload);
    $this->assertEquals('signage.url', $e::name());
  }

  /**
   * @covers ::getUrl
   */
  public function testGetUrl() {
    // Create an event payload.
    $payload = new EventPayload();
    // Create a url event.
    $e = new UrlEvent($payload);
    $e->setUrl('http://www.example.com');

    $this->assertEquals('http://www.example.com', $e->getUrl());
  }

}
