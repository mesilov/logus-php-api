<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Services\Reservation\Result;

use DateTimeImmutable;
use Mesilov\Logus\Api\Core\Result\AbstractItem;

/**
 * @property-read int Id
 * @property-read string Guid
 * @property-read int SharedBookingId
 * @property-read int GenericNo
 * @property-read string ReservationName
 * @property-read DateTimeImmutable ArrivalDate
 * @property-read DateTimeImmutable DepartureDate
 * @property-read string Status
 * @property-read string ReferralId
 * @property-read string Notes
 * @property-read string RoomTypeCode
 * @property-read string RateCode
 * @property-read string RoomNo
 * @property-read array Layout
 * @property-read array Guarantee
 * @property-read ?float DepositAmount
 * @property-read DateTimeImmutable DepositDueDate
 * @property-read array Tags
 * @property-read string LocalCurrencyBalance
 * @property-read string PaymentsSum
 * @property-read string LocalCurrencyBalanceForecast
 * @property-read string LocalCurrencyStayAmount
 * @property-read string PayingCompanyGenericNo
 * @property-read string PayingCompanyName
 * @property-read string CompanyProfileName
 * @property-read string OnlinePaymentHyperlink
 * @property-read array MainGuest
 * @property-read int MarketSegmentId
 * @property-read int TrackCodeId
 * @property-read int OpenCodeId
 * @property-read int GeoCodeId
 * @property-read int BookingSourceId
 * @property-read int CreatedUserId
 * @property-read int ModifiedUserId
 * @property-read DateTimeImmutable CreatedDate
 * @property-read DateTimeImmutable ModifiedDate
 * @property-read string CrsAccount
 * @property-read string ChannelId
 * @property-read int FolioId
 * @property-read array Guests
*/
class ReservationItem extends AbstractItem
{
}