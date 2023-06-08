<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Tests\Integration\Core;

use Mesilov\Logus\Api\Core\ApiClient;
use Mesilov\Logus\Api\Core\Contracts\ApiClientInterface;
use Mesilov\Logus\Api\Core\Contracts\CoreInterface;
use Mesilov\Logus\Api\Core\CoreBuilder;
use Mesilov\Logus\Api\Core\Credentials;
use Mesilov\Logus\Api\Core\Exceptions\TransportException;
use Mesilov\Logus\Api\Tests\Integration\Fabric;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\HttpClient;

class CoreTest extends TestCase
{
    protected CoreInterface $core;

    public function testCallMethod(): void
    {
        $response = $this->core->call('GET', 'Account/Ping', []);
        $this->assertEquals(200, $response->getHttpResponse()->getStatusCode());
    }

    public function setUp(): void
    {
        $this->core = (new CoreBuilder())
            ->withCredentials(new Credentials($_ENV['LOGUS_API_ENDPOINT_URL'], $_ENV['LOGUS_AUTH_TOKEN']))
            ->withLogger(Fabric::getLogger())
            ->build();
    }
}