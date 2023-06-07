<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Services\Reservation\Result;

use Mesilov\Logus\Api\Core\Exceptions\BaseException;
use Mesilov\Logus\Api\Core\Result\AbstractResult;

class ReservationsResult extends AbstractResult
{
    /**
     * @return ReservationItem[]
     * @throws BaseException
     */
    public function getReservations(): array
    {
        $res = [];
        foreach ($this->getCoreResponse()->getResponseData() as $reservation) {
            $res[] = new ReservationItem($reservation);
        }
        return $res;
    }
}