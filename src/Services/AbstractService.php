<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Services;

use Mesilov\Logus\Api\Core\Contracts\CoreInterface;
use Money\Formatter\DecimalMoneyFormatter;
use Psr\Log\LoggerInterface;

readonly abstract class AbstractService
{
    public function __construct(public CoreInterface            $core,
                                protected DecimalMoneyFormatter $decimalMoneyFormatter,
                                protected LoggerInterface       $log)
    {
    }
}