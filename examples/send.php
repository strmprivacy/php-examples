<?php

use Examples\Events\DemoEvent;
use Examples\Utils\ClientBuilder;
use StrmPrivacy\Driver\Enums\SerializationType;
use StrmPrivacy\Driver\Sender;

include_once(realpath(dirname(__FILE__)) . '/../vendor/autoload.php');

/** @var \StrmPrivacy\Driver\Sender $sender */
$sender = ClientBuilder::build($argv, Sender::class);
// or instantiate a Sender class directly:
// $sender = new \StrmPrivacy\Driver\Sender('billingId', 'clientId', 'clientSecret');

while (true) {
    $event = new DemoEvent();

    $event->eventContractRef = 'streammachine/example/1.2.3';
    $event->consentLevels = [0];
    $event->uniqueIdentifier = uniqid();
    $event->someSensitiveValue = 'A value that should be encrypted';
    $event->consistentValue = 'a-user-session';
    $event->notSensitiveValue = 'Hello from PHP';

    $sender->send($event, SerializationType::AVRO_BINARY);
    sleep(0.5);
}
