<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Services\Reservation\Result;

use Mesilov\Logus\Api\Core\Exceptions\BaseException;
use Mesilov\Logus\Api\Core\Result\AbstractResult;

class ReservationResult extends AbstractResult
{
    /**
     * @throws BaseException
     */
    public function getReservation(): ReservationItem
    {
        return new ReservationItem($this->getCoreResponse()->getResponseData());
    }
}