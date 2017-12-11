<?php
/**
 * Log incomming webhooks.
 */

namespace Drupal\signage_request_log\Controller;


use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RequestStack;

class RequestLogController extends ControllerBase {

  /**
   * @var \Symfony\Component\HttpFoundation\RequestStack
   */
  protected $requestStack;

  /**
   * RequestLogController constructor.
   *
   * @param \Symfony\Component\HttpFoundation\RequestStack $request_stack
   */
  public function __construct(RequestStack $request_stack) {
    $this->requestStack = $request_stack;
  }

  /**
   * @inheritDoc
   */
  public static function create(ContainerInterface $container) {
    return new static($container->get('request_stack'));
  }

  /**
   * Log the request.
   */
  public function log() {
    $req = $this->requestStack->getCurrentRequest();

    \Drupal::logger('signage_request_log')->info(
      'Headers: %headers Content: %string',
      array('%headers' => $req->headers, '%string' => $req->getContent())
    );

    return new JsonResponse('ok');
  }

}
