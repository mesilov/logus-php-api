<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Core;

use Mesilov\Logus\Api\Core\Contracts\ApiClientInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class ApiClient implements ApiClientInterface
{
    protected HttpClientInterface $client;
    protected LoggerInterface $logger;
    protected Credentials $credentials;
    protected const SDK_VERSION = '0.1';
    protected const USER_AGENT = 'mesilov-logus-php-api-client';

    public function __construct(Credentials $credentials, HttpClientInterface $client, LoggerInterface $logger)
    {
        $this->credentials = $credentials;
        $this->client = $client;
        $this->logger = $logger;
        $this->logger->debug(
            'ApiClient.init',
            [
                'httpClientType' => get_class($client),
            ]
        );
    }

    /**
     * @return array<string,string>
     */
    protected function getDefaultHeaders(): array
    {
        return [
            'Accept' => 'application/json',
            'Accept-Charset' => 'utf-8',
            'User-Agent' => sprintf('%s-v-%s-php-%s', self::USER_AGENT, self::SDK_VERSION, PHP_VERSION),
            'X-MESILOV-LOGUS-PHP-API-CLIENT-PHP-VERSION' => PHP_VERSION,
            'X-MESILOV-LOGUS-PHP-API-CLIENT-VERSION' => self::SDK_VERSION,
        ];
    }

    /**
     * @inheritDoc
     */
    public function getCredentials(): Credentials
    {
        return $this->credentials;
    }


    /**
     * @inheritDoc
     */
    public function getResponse(string $httpMethod, string $apiMethodName, array $parameters = []): ResponseInterface
    {
        $this->logger->info(
            'getResponse.start',
            [
                'apiMethod' => $apiMethodName,
                'apiEndpointUrl' => $this->credentials->apiEndpointUrl,
                'parameters' => $parameters,
            ]
        );

        $url = sprintf('%s/api/%s', $this->getCredentials()->apiEndpointUrl, $apiMethodName);

        $requestOptions = [
            'json' => $parameters,
            'headers' => array_merge(
                $this->getDefaultHeaders(),
                [
                    'Authorization' => $this->credentials->authToken
                ],
            ),
        ];
        $response = $this->client->request($httpMethod, $url, $requestOptions);

        $this->logger->info(
            'getResponse.end',
            [
                'apiMethod' => $apiMethodName,
                'responseInfo' => $response->getInfo(),
            ]
        );

        return $response;
    }
}