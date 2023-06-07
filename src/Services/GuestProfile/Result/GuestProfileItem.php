<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Services\GuestProfile\Result;

use DateTimeImmutable;
use Mesilov\Logus\Api\Core\Result\AbstractItem;

/**
 * @property-read ?DateTimeImmutable ArrivalDate
 * @property-read ?DateTimeImmutable DepartureDate
 * @property-read float Balance
 * @property-read ?DateTimeImmutable BirthDate
 * @property-read ?string LanguageCode
 * @property-read bool NoPost
 * @property-read ?string CustomFieldValues
 * @property-read ?string Email
 * @property-read ?string Title
 * @property-read ?string FirstName
 * @property-read string GenericNo
 * @property-read ?string ProfileGenericNo
 * @property-read string Guid
 * @property-read string Id
 * @property-read ?string LastName
 * @property-read ?string MiddleName
 * @property-read ?string Notes
 * @property-read array Phones
 * @property-read ?string Phone
 * @property-read bool ReceiveSmsNotifications
 * @property-read string Sex
 * @property-read array DocumentData
 * @property-read string CitizenshipCountryCode
 * @property-read array Tags
 * @property-read bool IsClosed
 * @property-read string MainProfileGenericNo
 * @property-read string MainProfileGuid
 * @property-read ?float DiscountPercent
 * @property-read ?string DiscountCode
 * @property-read ?string KeyCards
 * @property-read ?array ExternalIds
 * @property-read ?string VehicleInfo
 * @property-read string CountryCode
 * @property-read string CountryName
 * @property-read string Region
 * @property-read string District
 * @property-read string City
 * @property-read string SettlementType
 * @property-read string Street
 * @property-read string HouseNo
 * @property-read string BuildingNo
 * @property-read string FlatNo
 * @property-read string Structure
 * @property-read string Zip
 * @property-read DateTimeImmutable CreatedDate
 * @property-read DateTimeImmutable ModifiedDate
 * @property-read array Folio
 */
class GuestProfileItem extends AbstractItem
{
}