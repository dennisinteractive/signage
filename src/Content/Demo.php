<?php
/**
 * Creates demo content.
 */

namespace Drupal\signage\Content;

use Drupal\node\Entity\Node;
use Drupal\taxonomy\Entity\Term;

/**
 * Class Device.
 *
 * @package Drupal\signage\Device
 */
class Demo implements DemoContentInterface {

  /**
   * @inheritDoc
   */
  public function create() {

    $url_term = Term::create([
      'vid' => 'signage_output_event_types',
      'name' => 'signage.url',
      'description' => 'Provides an object of \Drupal\signage\Event\UrlEventInterface',
    ]);
    $url_term->save();

    $msg_term = Term::create([
      'vid' => 'signage_output_event_types',
      'name' => 'signage.message',
      'description' => 'Provides an object of \Drupal\signage\Event\MessageEventInterface',
    ]);
    $msg_term->save();

    // Create some initial content.
    $demo_output_url_term = Term::create([
      'vid' => 'signage_output_events',
      'name' => 'Demo url set',
      'field_signage_output_event_type' => $url_term->id(),
      'field_signage_output' => [
        '[url]?[key_1]=[value_1]&[key_2]=[value_2]',
      ],
    ]);
    $demo_output_url_term->save();

    $demo_output_msg = Term::create([
      'vid' => 'signage_output_events',
      'name' => 'Debug message',
      'field_signage_output_event_type' => $msg_term->id(),
      'field_signage_output' => [
        '{
        "title": "Demo message for [Site]",
        "body": "Foo = [FOO], Bar = [BAR]",
        "notification_type": "success",
        "timeout": "120000"
      }',
      ],
    ]);
    $demo_output_msg->save();

    $output_tube = Term::create([
      'vid' => 'signage_output_events',
      'name' => 'Show tube status',
      'field_signage_output_event_type' => $url_term->id(),
      'field_signage_output' => [
        'https://tfl.gov.uk/tfl/syndication/feeds/serviceboard-fullscreen.htm',
      ],
    ]);
    $output_tube->save();

    $demo_input_url_term = Term::create([
      'vid' => 'signage_input_events',
      'name' => 'Demo Input Url',
      'field_signage_subscribe_name' => [
        'value' => 'demo.input.url',
      ],
    ]);
    $demo_input_url_term->save();

    $demo_input_msg = Term::create([
      'vid' => 'signage_input_events',
      'name' => 'Demo input message',
      'field_signage_subscribe_name' => [
        'value' => 'demo.input.message',
      ],
    ]);
    $demo_input_msg->save();

    $input_tube = Term::create([
      'vid' => 'signage_input_events',
      'name' => 'Time to show tube status',
      'field_signage_subscribe_name' => [
        'value' => 'signage.input.tube',
      ],
    ]);
    $input_tube->save();

    // Demo action.
    $demo_action_node = Node::create([
      'type' => 'signage_action',
      'title'  => 'Demo url',
      'field_signage_on_input_event' => [
        'target_id' => $demo_input_url_term->id(),
      ],
      'field_signage_do_output_event' => [
        'target_id' => $demo_output_url_term->id(),
      ],
    ]);
    $demo_action_node->save();

    $demo_action_msg = Node::create([
      'type' => 'signage_action',
      'title'  => 'Demo message',
      'field_signage_on_input_event' => [
        'target_id' => $demo_input_msg->id(),
      ],
      'field_signage_do_output_event' => [
        'target_id' => $demo_output_msg->id(),
      ],
    ]);
    $demo_action_msg->save();

    // Tube status action.
    $tube_action = Node::create([
      'type' => 'signage_action',
      'title'  => 'Tube status',
      'field_signage_on_input_event' => [
        'target_id' => $input_tube->id(),
      ],
      'field_signage_do_output_event' => [
        'target_id' => $output_tube->id(),
      ],
    ]);
    $tube_action->save();

    // Web Dev channel
    $dev_channel_node = Node::create([
      'type' => 'signage_channel',
      'title'  => 'Web Dev',
      'field_signage_actions' => [
        ['target_id' => $demo_action_node->id()],
        ['target_id' => $demo_action_msg->id()],
        ['target_id' => $tube_action->id()],
      ],
      'field_signage_default_url' => [
        'value' => 'http://www.drupal.org',
      ],
    ]);
    $dev_channel_node->save();

    // Forth floor device
    $demo_device_node = Node::create([
      'type' => 'signage_device',
      'title'  => 'Floor4 North',
      'field_signage_channel' => [
        'target_id' => $dev_channel_node->id(),
      ],
    ]);
    $demo_device_node->save();

    // Another forth floor device
    $demo_device_node = Node::create([
      'type' => 'signage_device',
      'title'  => 'Floor4 South',
      'field_signage_channel' => [
        'target_id' => $dev_channel_node->id(),
      ],
    ]);
    $demo_device_node->save();

  }

}
