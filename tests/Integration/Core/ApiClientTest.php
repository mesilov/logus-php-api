<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Tests\Integration\Core;

use Mesilov\Logus\Api\Core\ApiClient;
use Mesilov\Logus\Api\Core\Contracts\ApiClientInterface;
use Mesilov\Logus\Api\Core\Credentials;
use Mesilov\Logus\Api\Core\Exceptions\TransportException;
use Mesilov\Logus\Api\Tests\Integration\Fabric;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\HttpClient;

class ApiClientTest extends TestCase
{
    protected ApiClientInterface $apiClient;

    public function testCallExistingApiMethod(): void
    {
        $response = $this->apiClient->getResponse('GET', 'Account/Ping', []);
        $this->assertEquals(200, $response->getStatusCode());
    }

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->apiClient = new ApiClient(
            Credentials::initFromArray($_ENV),
            HttpClient::create(
                [
                    'http_version' => '2.0',
                    'timeout' => 120,
                ]
            ),
            Fabric::getLogger()
        );
    }
}