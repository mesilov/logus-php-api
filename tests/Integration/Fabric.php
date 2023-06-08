<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Tests\Integration;

use Mesilov\Logus\Api\Core\Contracts\CoreInterface;
use Mesilov\Logus\Api\Core\CoreBuilder;
use Mesilov\Logus\Api\Core\Credentials;
use Mesilov\Logus\Api\Core\Exceptions\InvalidArgumentException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\IntrospectionProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Psr\Log\LoggerInterface;

/**
 * Class Fabric
 *
 * @package Bitrix24\SDK\Tests\Integration
 */
class Fabric
{
    public static function getServiceBuilder(): ServiceBuilder
    {
        return new ServiceBuilder(self::getCore(), self::getBatchService(), self::getBulkItemsReader(), self::getLogger());
    }


    /**
     * @throws InvalidArgumentException
     */
    public static function getCore(): CoreInterface
    {
        return (new CoreBuilder())
            ->withLogger(self::getLogger())
            ->withCredentials(new Credentials(
                $_ENV['LOGUS_API_ENDPOINT_URL'],
                $_ENV['LOGUS_AUTH_TOKEN'],
            ))
            ->build();
    }

    /**
     * @return \Psr\Log\LoggerInterface
     */
    public static function getLogger(): LoggerInterface
    {
        $log = new Logger('integration-test');
        $log->pushHandler(new StreamHandler(STDOUT, (int)$_ENV['INTEGRATION_TEST_LOG_LEVEL']));
        $log->pushProcessor(new MemoryUsageProcessor(true, true));
        $log->pushProcessor(new IntrospectionProcessor());

        return $log;
    }
}