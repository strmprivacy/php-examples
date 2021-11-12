<?php

namespace Examples\Events;

use AvroSchema;
use StrmPrivacy\Driver\Contracts\Event;

class DemoEvent implements Event
{
    public $consentLevels;

    public $uniqueIdentifier;

    public $consistentValue;

    public $someSensitiveValue;

    public $notSensitiveValue;

    public $eventContractRef;

    public function getStrmSchemaRef(): string
    {
        return 'streammachine/demo/1.0.2';
    }

    public function toArray(): array
    {
        return [
            'strmMeta' => [
                'eventContractRef' => $this->eventContractRef,
                'nonce' => null,
                'timestamp' => null,
                'keyLink' => null,
                'billingId' => null,
                'consentLevels' => $this->consentLevels,
            ],
            'uniqueIdentifier' => $this->uniqueIdentifier,
            'consistentValue' => $this->consistentValue,
            'someSensitiveValue' => $this->someSensitiveValue,
            'notSensitiveValue' => $this->notSensitiveValue,
        ];
    }

    public function getStrmSchema(): AvroSchema
    {
        $json = file_get_contents(realpath(dirname(__FILE__)) . '/../../assets/schemas/demo.avsc');

        return AvroSchema::parse($json);
    }
}
