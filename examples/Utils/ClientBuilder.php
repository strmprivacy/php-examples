<?php

namespace Examples\Utils;

use InvalidArgumentException;
use StrmPrivacy\Driver\Client;

class ClientBuilder
{
    protected const DEFAULT_CLASS = Client::class;

    public static function build(array $args, string $subClass = null, string $gatewayHost = 'events.strmprivacy.io', string $stsHost = 'sts.strmprivacy.io'): Client
    {
        if ($subClass === null) {
            $subClass = self::DEFAULT_CLASS;
        } else {
            if (!is_a($subClass, self::DEFAULT_CLASS, true)) {
                throw new InvalidArgumentException('Invalid subclass ' . $subClass);
            }
        }

        if (count($args) < 4) {
            throw new InvalidArgumentException("Usage: ${args[0]} <billingId> <clientId> <clientSecret>");
        }

        return new $subClass($args[1], $args[2], $args[3], [
            'gatewayHost' => $gatewayHost,
            'stsHost' => $stsHost
        ]);
    }
}
