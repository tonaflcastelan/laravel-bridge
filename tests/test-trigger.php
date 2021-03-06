<?php declare(strict_types=1);

use Bref\Context\Context;
use Bref\LaravelBridge\Queue\LaravelSqsHandler;

/** @var \Bref\LaravelBridge\Queue\LaravelSqsHandler $handler */
$handler = require __DIR__ . '/App/handler.php';

$event = json_decode(file_get_contents(__DIR__ . '/Fixture/sqs-event.json'), true, 512, JSON_THROW_ON_ERROR);
// Replace the body of the message with a body generated by Laravel
// That way we are sure we are testing with a correctly encoded message
$event['Records'][0]['body'] = file_get_contents(__DIR__ . '/Fixture/sqs-event-body.json');

$handler->handle($event, new Context('abc', 0, 'def', 'ijk'));
