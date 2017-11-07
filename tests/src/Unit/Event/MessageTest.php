<?php

namespace Drupal\Tests\signage\Unit;


use Drupal\signage\Event\Message;
use Drupal\Tests\UnitTestCase;

/**
 * MessageTest
 *
 * @coversDefaultClass Drupal\signage\Event\Message
 *
 * @group signage_test
 */
class MessageTest extends UnitTestCase {

  /**
   * @covers ::setTitle
   * @covers ::getTitle
   */
  public function testSetTitle() {
    $m = new Message();
    $m->setTitle('Foo');
    $this->assertEquals('Foo', $m->getTitle());
  }

  /**
   * @covers ::setBody
   * @covers ::getBody
   */
  public function testSetBody() {
    $m = new Message();
    $m->setBody('bar');
    $this->assertEquals('bar', $m->getBody());
  }

  /**
   * @covers ::setNotificationType
   * @covers ::getNotificationType
   */
  public function testSetNotificationType() {
    $m = new Message();
    $m->setNotificationType('test');
    $this->assertEquals('test', $m->getNotificationType());
  }

  /**
   * @covers ::setTimeout
   * @covers ::getTimeout
   */
  public function testSetTimeout() {
    $m = new Message();
    $m->setTimeout(100000);
    $this->assertEquals(100000, $m->getTimeout());

    // Check that strings get converted to integers.
    $m->setTimeout('100');
    $this->assertEquals(100, $m->getTimeout());
  }

}
