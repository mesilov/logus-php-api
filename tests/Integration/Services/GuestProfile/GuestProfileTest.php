<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Tests\Integration\Services\GuestProfile;

use Mesilov\Logus\Api\Core\Contracts\CoreInterface;
use Mesilov\Logus\Api\Core\CoreBuilder;
use Mesilov\Logus\Api\Core\Credentials;
use Mesilov\Logus\Api\Services\GuestProfile\GuestProfileFilter;
use Mesilov\Logus\Api\Services\ServiceBuilder;
use Mesilov\Logus\Api\Tests\Integration\Fabric;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use PHPUnit\Framework\TestCase;

class GuestProfileTest extends TestCase
{
    protected CoreInterface $core;
    protected ServiceBuilder $serviceBuilder;

    public function testSearchMethod(): void
    {
        $response = $this->serviceBuilder->guestProfile()->search(new GuestProfileFilter());
        $this->assertEquals(200, $response->getCoreResponse()->getHttpResponse()->getStatusCode());
    }

    public function setUp(): void
    {
        $this->serviceBuilder =
            new ServiceBuilder (
                (new CoreBuilder())
                    ->withCredentials(Credentials::initFromArray($_ENV))
                    ->withLogger(Fabric::getLogger())
                    ->build(),
                new DecimalMoneyFormatter(new ISOCurrencies()),
                Fabric::getLogger());
    }
}