<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Core;

use Mesilov\Logus\Api\Core\Contracts\ApiClientInterface;
use Mesilov\Logus\Api\Core\Contracts\CoreInterface;
use Mesilov\Logus\Api\Core\Exceptions\InvalidArgumentException;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class CoreBuilder
{
    protected HttpClientInterface $httpClient;
    protected LoggerInterface $logger;

    public function __construct(
        protected ?ApiClientInterface $apiClient = null,
        protected ?Credentials        $credentials = null
    )
    {
        $this->logger = new NullLogger();
        $this->httpClient = HttpClient::create(
            [
                'http_version' => '2.0',
                'timeout' => 120,
            ]
        );
        $this->credentials = null;
        $this->apiClient = null;
    }

    /**
     * @param Credentials $credentials
     *
     * @return $this
     */
    public function withCredentials(Credentials $credentials): self
    {
        $this->credentials = $credentials;

        return $this;
    }

    /**
     * @param ApiClientInterface $apiClient
     *
     * @return $this
     */
    public function withApiClient(ApiClientInterface $apiClient): self
    {
        $this->apiClient = $apiClient;

        return $this;
    }

    /**
     * @param HttpClientInterface $httpClient
     * @return CoreBuilder
     */
    public function withHttpClient(HttpClientInterface $httpClient): CoreBuilder
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * @param LoggerInterface $logger
     *
     * @return $this
     */
    public function withLogger(LoggerInterface $logger): self
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * @return CoreInterface
     * @throws InvalidArgumentException
     */
    public function build(): CoreInterface
    {
        if ($this->credentials === null) {
            throw new InvalidArgumentException('you must set credentials before call method build');
        }

        if ($this->apiClient === null) {
            $this->apiClient = new ApiClient(
                $this->credentials,
                $this->httpClient,
                $this->logger
            );
        }

        return new Core(
            $this->apiClient,
            $this->logger
        );
    }
}