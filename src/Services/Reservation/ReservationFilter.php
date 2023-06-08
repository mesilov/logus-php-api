<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Services\Reservation;

use Mesilov\Logus\Api\Services\GuestProfile\GuestProfileFilter;

class ReservationFilter
{
    private ?string $query = null;
    private ?string $lastName = null;
    private ?string $genericNo = null;
    private ?array $genericNos = null;
    private ?int $sharedBookingId = null;
    private ?array $statuses = null;

    private ?string $guestPhone = null;

    /**
     * @param string $query
     * @return ReservationFilter
     */
    public function withQuery(string $query): ReservationFilter
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @param string $lastName
     * @return ReservationFilter
     */
    public function withLastName(string $lastName): ReservationFilter
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @param string $genericNo
     * @return ReservationFilter
     */
    public function withGenericNo(string $genericNo): ReservationFilter
    {
        $this->genericNo = $genericNo;
        return $this;
    }

    /**
     * Номера броней (если необходимо выполнить поиск по нескольким броням сразу)
     *
     * @param array $genericNos
     * @return ReservationFilter
     */
    public function withGenericNos(array $genericNos): ReservationFilter
    {
        $this->genericNos = $genericNos;
        return $this;
    }

    /**
     * Идентификатор разделённой брони
     *
     * @param int $sharedBookingId
     * @return ReservationFilter
     */
    public function withSharedBookingId(int $sharedBookingId): ReservationFilter
    {
        $this->sharedBookingId = $sharedBookingId;
        return $this;
    }

    /**
     * Список статусов
     *
     * @param array $statuses
     * @return $this
     */
    public function withStatuses(array $statuses): ReservationFilter
    {
        $this->statuses = $statuses;
        return $this;
    }

    /**
     * Телефонный номер гостя (основной). Если указан, будет произведён поиск среди основного телефона основных гостей брони
     *
     * @param string $guestPhone
     * @return $this
     */
    public function withGuestPhone(string $guestPhone): ReservationFilter
    {
        $this->guestPhone = $guestPhone;
        return $this;
    }



//Logus.HMS.BL.Contracts.Booking.BookingFilter {
//ArrivalDateFrom (string, optional): Дата заезда (с) ,
//ArrivalDateTo (string, optional): Дата заезда (по), включительно ,
//BookingDateFrom (string, optional): Дата проживания (с) ,
//BookingDateTo (string, optional): Дата проживания (по), включительно ,
//DepartureDateFrom (string, optional): Дата выезда (с) ,
//DepartureDateTo (string, optional): Дата выезда (по), включительно ,
//CreatedDateFrom (string, optional): Дата создания (с) ,
//CreatedDateTo (string, optional): Дата создания (по), включительно ,
//ModifiedDateFrom (string, optional): Дата изменения (с) ,
//ModifiedDateTo (string, optional): Дата изменения (по), включительно ,
//DepositDueDate (Logus.HMS.Entities.Shared.OpenDateRange, optional): Интервал дат (с/по), в которые необходимо оплатить гарантию брони ,
//UnpaidOnly (boolean, optional): Отображать только неоплаченные ,
//PropertyId (integer, optional): Идентификатор объекта (отеля) ,
//QuotaId (integer, optional): Идентификатор квоты ,
//RoomNo (string, optional): Номер комнаты ,
//IncludeRevenue (boolean, optional): Производить или нет расчет стоимости доходных транзакций - может сказываться на быстродействии ,
//ReservationId (integer, optional): Идентификатор брони ,
//ReservationIds (Array[integer], optional): Идентификаторы броней (если нужен множественный поиск) ,
//CrsAccount (string, optional): Код во внешней системе бронирования ,
//ChannelId (integer, optional): Идентификатор внешнего канала бронирования ,
//Statuses (Array[Logus.HMS.Entities.ReservationStatus], optional): Список статусов ,
//ForceLateBookings (boolean, optional): Если установлен в true, в выборку попадут опаздавшие брони вне зависимости от статуса и дат заезда ,
//GuestTagId (integer, optional): Тег гостя ,
//GuestPhones (Array[string], optional): Телефонные номера гостя (если совпадёт один из них) ,
//GuestPhone (string, optional):  ,
//GuestEmail (string, optional): Email главного гостя. ,
//LastName (string, optional): Фамилия основного гостя ,
//HasAgents (boolean, optional): Только брони с агентами ,
//TrackEntries (boolean, optional): Управляет заполнением значений в словаре OriginalValues. ,
//OnlyBoundToProfiles (boolean, optional): Если флаг установлен, будут выбраны только те брони, основной гость которых привязан к профилю ,
//OnlyWithRoomAssigned (boolean, optional): Только с назначенными комнатами ,

//ReferralId (string, optional): Поиск по группе броней ,
//Skip (integer, optional): Число записей, которые необходимо "пропустить" ,
//Limit (integer, optional): Ограничение на кол-во записей ,
//StayChargeUnit (Logus.HMS.Entities.Dictionaries.StayChargeUnit, optional): Единица расчёта проживания (см. {Logus.HMS.BL.Contracts.Booking.BookingFilter.StayChargeUnit}) ,
//ExternalId (Logus.HMS.BL.Contracts.Booking.ExternalIdFilter, optional): Поиск по внешнему идентификатору ,
//CancellationReasonIds (Array[integer], optional): Причины аннуляции брони ,
//ReservationsIds (Array[integer], optional): Идентификаторы броней ,
//KeyCardNo (string, optional): Поиск по номеру ключ-карты ,
//Order (string, optional) = ['ById', 'ByDepartureDateDesc'],
//TagIds (Array[integer], optional)
//}
//Logus.HMS.Entities.Shared.OpenDateRange {
//    DateTimeFrom (string, optional): Начало интервала ,
//DateTimeTo (string, optional): Конец интервала
//}
//Logus.HMS.Entities.ReservationStatus {
//    Code (string, optional),
//Name (string, optional)
//}
//Logus.HMS.Entities.Dictionaries.StayChargeUnit {
//    Code (string, optional),
//Name (string, optional)
//}
//Logus.HMS.BL.Contracts.Booking.ExternalIdFilter {
//    SystemId (string, optional): Внешняя система (код, краткое наименование) ,
//Value (string, optional): Идентификатор во внешней системе
//}
//Logus.HMS.Entities.Reservation


    /**
     * @return array
     */
    public function build(): array
    {
        $filter = [];
        if ($this->query !== null) {
            $filter['Query'] = $this->query;
        }
        if ($this->lastName !== null) {
            $filter['LastName'] = $this->lastName;
        }
        if ($this->genericNo !== null) {
            $filter['genericNo'] = $this->genericNo;
        }
        if ($this->genericNos !== null) {
            $filter['genericNos'] = $this->genericNos;
        }
        if ($this->sharedBookingId !== null) {
            $filter['SharedBookingId'] = $this->sharedBookingId;
        }
        if ($this->statuses !== null) {
            $filter['Statuses'] = $this->statuses;
        }
        if ($this->guestPhone !== null) {
            $filter['GuestPhone'] = $this->guestPhone;
        }
        return $filter;
    }
}