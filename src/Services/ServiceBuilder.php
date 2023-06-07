<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Services;

use Mesilov\Logus\Api\Core\Contracts\CoreInterface;
use Mesilov\Logus\Api\Services\GuestProfile\GuestProfile;
use Mesilov\Logus\Api\Services\Reservation\Reservation;
use Money\Currencies\ISOCurrencies;
use Money\Formatter\DecimalMoneyFormatter;
use Psr\Log\LoggerInterface;

class ServiceBuilder
{
    protected array $serviceCache;

    public function __construct(
        protected CoreInterface       $core,
        private DecimalMoneyFormatter $decimalMoneyFormatter,
        protected LoggerInterface     $log)
    {
    }

    /**
     * @return GuestProfile
     */
    public function guestProfile(): GuestProfile
    {
        if (!isset($this->serviceCache[__METHOD__])) {
            $this->serviceCache[__METHOD__] = new GuestProfile($this->core, $this->decimalMoneyFormatter, $this->log);
        }

        return $this->serviceCache[__METHOD__];
    }

    /**
     * @return Reservation
     */
    public function reservation(): Reservation
    {
        if (!isset($this->serviceCache[__METHOD__])) {
            $this->serviceCache[__METHOD__] = new Reservation($this->core, $this->decimalMoneyFormatter, $this->log);
        }

        return $this->serviceCache[__METHOD__];
    }
}