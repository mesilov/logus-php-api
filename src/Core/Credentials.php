<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Core;

readonly class Credentials
{
    public function __construct(
        public string $apiEndpointUrl,
        public string $authToken
    )
    {
    }

    /**
     * @param array $array
     * @return self
     */
    public static function initFromArray(array $array): self
    {
        return new self($array['LOGUS_API_ENDPOINT_URL'], $array['LOGUS_AUTH_TOKEN']);
    }
}