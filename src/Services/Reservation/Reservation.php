<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Services\Reservation;

use Mesilov\Logus\Api\Services\AbstractService;
use Mesilov\Logus\Api\Services\Common\Pagination;
use Mesilov\Logus\Api\Services\Reservation\Result\ReservationsResult;

readonly class Reservation extends AbstractService
{
    /**
     * Осуществляет быстрый поиск броней по множеству критериев, возвращает более легковесные результаты по сравнению с методом {M:Logus.HMS.WebApi.Api.ReservationController.Search(Logus.HMS.BL.Contracts.Booking.BookingFilter)}.
     *
     * @param ReservationFilter $reservationFilter
     * @param ReservationSelect|null $reservationSelect
     * @param Pagination|null $pagination
     * @return ReservationsResult
     */
    public function quickSearch(ReservationFilter $reservationFilter, ?ReservationSelect $reservationSelect = null, ?Pagination $pagination = null): ReservationsResult
    {
        if ($pagination === null) {
            $pagination = Pagination::default();
        }
        return new ReservationsResult(
            $this->core->call('POST', 'Reservation/QuickSearch',
                array_merge(
                    $reservationFilter->build(),
                    $reservationSelect !== null ? $reservationSelect->build() : [],
                    [
                        'Skip' => $pagination->skip,
                        'Limit' => $pagination->limit,
                    ]
                )
            )
        );
    }
}