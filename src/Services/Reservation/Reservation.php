<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Services\Reservation;

use Mesilov\Logus\Api\Services\AbstractService;
use Mesilov\Logus\Api\Services\Common\Pagination;
use Mesilov\Logus\Api\Services\Reservation\Result\ReservationsResult;

readonly class Reservation extends AbstractService
{
    /**
     * @param ReservationFilter $reservationFilter
     * @param Pagination|null $pagination
     * @return ReservationsResult
     */
    public function quickSearch(ReservationFilter $reservationFilter, ?Pagination $pagination = null): ReservationsResult
    {
        if ($pagination === null) {
            $pagination = Pagination::default();
        }
        return new ReservationsResult(
            $this->core->call('POST', 'Reservation/QuickSearch',
                array_merge(
                    $reservationFilter->build(),
                    [
                        'Skip' => $pagination->skip,
                        'Limit' => $pagination->limit,
                    ]
                )
            )
        );
    }
}