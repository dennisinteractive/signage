<?php

namespace Drupal\Tests\signage\Unit;


use Drupal\signage\Event\EventPayload;
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
    $e = new UrlEvent();
    $this->assertEquals('signage.url', $e::name());
  }

  /**
   * @covers ::getUrl
   */
  public function testGetUrl() {
    // Populate an event payload.
    $payload = new EventPayload();
    $payload->setValue(0, 'http://www.example.com');

    $e = new UrlEvent();
    $e->setPayload($payload);

    $this->assertEquals('http://www.example.com', $e->getUrl());
  }

}
