<?php

namespace Drupal\Tests\signage\Unit;


use Drupal\signage\Event\EventPayload;
use Drupal\signage\Event\EventPayloadInterface;
use Drupal\signage\Event\UrlEvent;
use Drupal\Tests\UnitTestCase;

/**
 * UrlEventTest
 *
 * @coversDefaultClass Drupal\signage\Event\UrlEvent
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
