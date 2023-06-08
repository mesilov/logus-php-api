<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Tests\Integration\Services\Reservation;

use Mesilov\Logus\Api\Core\ApiClient;
use Mesilov\Logus\Api\Core\Contracts\ApiClientInterface;
use Mesilov\Logus\Api\Core\Contracts\CoreInterface;
use Mesilov\Logus\Api\Core\CoreBuilder;
use Mesilov\Logus\Api\Core\Credentials;
use Mesilov\Logus\Api\Core\Exceptions\TransportException;
use Mesilov\Logus\Api\Services\Common\Pagination;
use Mesilov\Logus\Api\Services\GuestProfile\GuestProfileFilter;
use Mesilov\Logus\Api\Services\Reservation\ReservationFilter;
use Mesilov\Logus\Api\Services\Reservation\ReservationSelect;
use Mesilov\Logus\Api\Services\ServiceBuilder;
use Mesilov\Logus\Api\Tests\Integration\Fabric;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\HttpClient;

class ReservationTest extends TestCase
{
    protected CoreInterface $core;
    protected ServiceBuilder $serviceBuilder;

    public function testQuickSearch(): void
    {
        $response = $this->serviceBuilder->reservation()->quickSearch((new ReservationFilter()));
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