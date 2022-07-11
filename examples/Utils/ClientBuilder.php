<?php

namespace Examples\Utils;

use InvalidArgumentException;
use StrmPrivacy\Driver\Client;

class ClientBuilder
{
    protected const DEFAULT_CLASS = Client::class;

    public static function build(array $args, string $subClass = null, string $gatewayHost = 'events.dev.strmprivacy.io', string $authHost = 'accounts.dev.strmprivacy.io'): Client
    {
        if ($subClass === null) {
            $subClass = self::DEFAULT_CLASS;
        } else {
            if (!is_a($subClass, self::DEFAULT_CLASS, true)) {
                throw new InvalidArgumentException('Invalid subclass ' . $subClass);
            }
        }

        if (count($args) < 3) {
            throw new InvalidArgumentException("Usage: ${args[0]} <clientId> <clientSecret>");
        }

        return new $subClass($args[1], $args[2], [
            'gatewayHost' => $gatewayHost,
            'authHost' => $authHost
        ]);
    }
}
