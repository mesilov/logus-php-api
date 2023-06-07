<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Services\Reservation;

use Mesilov\Logus\Api\Services\GuestProfile\GuestProfileFilter;

class ReservationFilter
{
    private ?string $query = null;
    private ?string $lastName = null;

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
//Query (string, optional): Свободный поисковый текст (для поиска по ФИО, номеру брони, компании, типу комнаты, комнате) ,
//RoomNo (string, optional): Номер комнаты ,
//IncludeRevenue (boolean, optional): Производить или нет расчет стоимости доходных транзакций - может сказываться на быстродействии ,
//GenericNo (string, optional): Номер брони ,
//GenericNos (Array[string], optional): Номера броней (если необходимо выполнить поиск по нескольким броням сразу) ,
//SharedBookingId (integer, optional): Идентификатор разделённой брони ,
//ReservationId (integer, optional): Идентификатор брони ,
//ReservationIds (Array[integer], optional): Идентификаторы броней (если нужен множественный поиск) ,
//CrsAccount (string, optional): Код во внешней системе бронирования ,
//ChannelId (integer, optional): Идентификатор внешнего канала бронирования ,
//Statuses (Array[Logus.HMS.Entities.ReservationStatus], optional): Список статусов ,
//ForceLateBookings (boolean, optional): Если установлен в true, в выборку попадут опаздавшие брони вне зависимости от статуса и дат заезда ,
//GuestTagId (integer, optional): Тег гостя ,
//GuestPhones (Array[string], optional): Телефонные номера гостя (если совпадёт один из них) ,
//GuestPhone (string, optional): Телефонный номер гостя (основной). Если указан, будет произведён поиск среди основного телефона основных гостей брони ,
//GuestEmail (string, optional): Email главного гостя. ,
//LastName (string, optional): Фамилия основного гостя ,
//HasAgents (boolean, optional): Только брони с агентами ,
//TrackEntries (boolean, optional): Управляет заполнением значений в словаре OriginalValues. ,
//OnlyBoundToProfiles (boolean, optional): Если флаг установлен, будут выбраны только те брони, основной гость которых привязан к профилю ,
//OnlyWithRoomAssigned (boolean, optional): Только с назначенными комнатами ,
//IncludeGuestProfile (boolean, optional): Если флаг установлен, то сущность гостя будет содержать привязанный к нему профиль ,
//IncludeGuestPhones (boolean, optional): Если флаг установлен, то сущность гостя будет содержать привязанные к нему телефоны ,
//IncludeCustomFields (boolean, optional): Если флаг установлен, то сущность гостя будет содержать привязанные CustomFields ,
//IncludeDocumentData (boolean, optional): Если флаг установлен, то сущность гостя будет содержать привязанные к нему паспортные данные ,
//ReferralId (string, optional): Поиск по группе броней ,
//Skip (integer, optional): Число записей, которые необходимо "пропустить" ,
//Limit (integer, optional): Ограничение на кол-во записей ,
//StayChargeUnit (Logus.HMS.Entities.Dictionaries.StayChargeUnit, optional): Единица расчёта проживания (см. {Logus.HMS.BL.Contracts.Booking.BookingFilter.StayChargeUnit}) ,
//ExternalId (Logus.HMS.BL.Contracts.Booking.ExternalIdFilter, optional): Поиск по внешнему идентификатору ,
//IncludeGuestCompletedVisitsCount (boolean, optional): Включить количество завершённых посещений гостя для броней, к которым привязан профиль гостя ,
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
        return $filter;
    }
}