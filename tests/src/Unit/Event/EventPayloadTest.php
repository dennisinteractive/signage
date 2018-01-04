<?php

namespace Drupal\Tests\signage\Unit;

use Drupal\signage\Event\Payload\EventPayload;
use Drupal\Tests\UnitTestCase;

/**
 * EventPayloadTest
 *
 * @coversDefaultClass Drupal\signage\Event\Payload\EventPayload
 *
 * @group signage_test
 */
class EventPayloadTest extends UnitTestCase {

  /**
   * @covers ::setValue
   * @covers ::getValues
   */
  public function testSetValue() {
    $p = new EventPayload();
    $p->setValue('foo', 'bar');
    $this->assertEquals('bar', $p->getValues()['foo']);
  }

  /**
   * @covers ::setValues
   * @covers ::getValues
   */
  public function testSetValues() {
    $p = new EventPayload();
    $p->setValues(['foo' => 'bar', 0 => 'zero']);
    $this->assertEquals('bar', $p->getValues()['foo']);
  }

  /**
   * @covers ::getValues
   */
  public function testGetValue() {
    $p = new EventPayload();
    // With nothing set, expect an empty array.
    $this->assertEquals([], $p->getValues());
  }

}
