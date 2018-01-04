<?php

namespace Drupal\Tests\signage\Unit;

use Drupal\signage\Event\Payload\EventPayloadInterface;
use Drupal\signage\Event\Input\InputEvent;
use Drupal\Tests\UnitTestCase;

/**
 * InputEventTest
 *
 * @coversDefaultClass Drupal\signage\Event\Input\InputEvent
 *
 * @group signage_test
 */
class InputEventTest extends UnitTestCase {

  /**
   * @covers ::setSource
   * @covers ::getSource
   */
  public function testSetSourceConstructor() {
    $e = new InputEvent('foo.bar');
    $this->assertEquals('foo.bar', $e->getSource());
  }

  /**
   * @covers ::setSource
   * @covers ::getSource
   */
  public function testSetSource() {
    $e = new InputEvent('foo.bar');
    $e->setSource('new.source');
    $this->assertEquals('new.source', $e->getSource());
  }

  /**
   * @covers ::setPayload
   * @covers ::getPayload
   */
  public function testSetPayload() {
    $payload = $this->getMockBuilder(EventPayloadInterface::class)
      ->getMock()
    ;

    $e = new InputEvent('foo.bar');
    $e->setPayload($payload);
    $this->assertEquals($payload, $e->getPayload());
  }

}
