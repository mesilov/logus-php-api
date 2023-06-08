<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Tests\Integration\Services\GuestProfile;

use Mesilov\Logus\Api\Core\ApiClient;
use Mesilov\Logus\Api\Core\Contracts\ApiClientInterface;
use Mesilov\Logus\Api\Core\Contracts\CoreInterface;
use Mesilov\Logus\Api\Core\CoreBuilder;
use Mesilov\Logus\Api\Core\Credentials;
use Mesilov\Logus\Api\Core\Exceptions\BaseException;
use Mesilov\Logus\Api\Core\Exceptions\TransportException;
use Mesilov\Logus\Api\Services\Common\Pagination;
use Mesilov\Logus\Api\Services\GuestProfile\GuestProfileFilter;
use Mesilov\Logus\Api\Services\ServiceBuilder;
use Mesilov\Logus\Api\Tests\Integration\Fabric;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\HttpClient;

class GuestProfileFetcherTest extends TestCase
{
    protected CoreInterface $core;
    protected ServiceBuilder $serviceBuilder;

    /**
     * @throws BaseException
     */
    public function testListMethod(): void
    {
        $cnt = 0;
        foreach ($this->serviceBuilder->guestProfileFetcher()->getList((new GuestProfileFilter())
            ->withPhone('8-916-961-42-45')
        ) as $cnt => $guestProfile) {
            $cnt++;
            if($cnt>1){
                break;
            }
        }
        $this->assertGreaterThanOrEqual(1, $cnt);
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