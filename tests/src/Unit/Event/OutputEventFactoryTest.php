<?php

namespace Drupal\Tests\signage\Unit;


use Drupal\signage\Event\OutputEventFactory;
use Drupal\signage\Event\UrlEvent;
use Drupal\Tests\UnitTestCase;

/**
 * OutputEventFactoryTest
 *
 * @coversDefaultClass Drupal\signage\Event\OutputEventFactory
 *
 * @group signage_test
 */
class OutputEventFactoryTest extends UnitTestCase {

  /**
   * @covers ::addEvent
   * @covers ::getEvent
   */
  public function testAddEvent() {
    $e = new UrlEvent();
    $factory = new OutputEventFactory();
    $factory->addEvent($e);
    $this->assertEquals($e, $factory->getEvent('signage.url'));
  }

}
