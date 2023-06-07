<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Core\Contracts;

use Mesilov\Logus\Api\Core;
use Mesilov\Logus\Api\Core\Exceptions\InvalidArgumentException;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

interface ApiClientInterface
{
    /**
     * @param string $httpMethod
     * @param string $apiMethodName
     * @param array $parameters
     *
     * @return ResponseInterface
     * @throws TransportExceptionInterface
     * @throws InvalidArgumentException
     */
    public function getResponse(string $httpMethod, string $apiMethodName, array $parameters = []): ResponseInterface;

    /**
     * @return Core\Credentials
     */
    public function getCredentials(): Core\Credentials;
}