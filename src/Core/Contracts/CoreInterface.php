<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Core\Contracts;

use Mesilov\Logus\Api\Core;

interface CoreInterface
{
    public const API_RESPONSE_PAGE_SIZE = 100;

    /**
     * @param string $httpMethod
     * @param string $apiMethod
     * @param array $parameters
     * @return Core\Response\Response
     */
    public function call(string $httpMethod, string $apiMethod, array $parameters = []): Core\Response\Response;

    /**
     * @return ApiClientInterface
     */
    public function getApiClient(): ApiClientInterface;
}