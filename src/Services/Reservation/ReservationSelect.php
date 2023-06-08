<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Services\Reservation;

class ReservationSelect
{
    private ?bool $includeGuestProfile = null;
    private ?bool $includeGuestPhones = null;
    private ?bool $includeCustomFields = null;
    private ?bool $includeDocumentData = null;
    private ?bool $includeGuestCompletedVisitsCount = null;

    /**
     * Если флаг установлен, то сущность гостя будет содержать привязанный к нему профиль
     *
     * @param bool|null $includeGuestProfile
     * @return ReservationSelect
     */
    public function withIncludeGuestProfile(?bool $includeGuestProfile): ReservationSelect
    {
        $this->includeGuestProfile = $includeGuestProfile;
        return $this;
    }

    /**
     * Если флаг установлен, то сущность гостя будет содержать привязанные к нему телефоны
     *
     * @param bool|null $includeGuestPhones
     * @return ReservationSelect
     */
    public function withIncludeGuestPhones(?bool $includeGuestPhones): ReservationSelect
    {
        $this->includeGuestPhones = $includeGuestPhones;
        return $this;
    }

    /**
     * Если флаг установлен, то сущность гостя будет содержать привязанные CustomFields
     *
     * @param bool|null $includeCustomFields
     * @return ReservationSelect
     */
    public function withIncludeCustomFields(?bool $includeCustomFields): ReservationSelect
    {
        $this->includeCustomFields = $includeCustomFields;
        return $this;
    }

    /**
     * Если флаг установлен, то сущность гостя будет содержать привязанные к нему паспортные данные
     *
     * @param bool|null $includeDocumentData
     * @return ReservationSelect
     */
    public function withIncludeDocumentData(?bool $includeDocumentData): ReservationSelect
    {
        $this->includeDocumentData = $includeDocumentData;
        return $this;
    }

    /**
     * Включить количество завершённых посещений гостя для броней, к которым привязан профиль гостя
     *
     * @param bool|null $includeGuestCompletedVisitsCount
     * @return ReservationSelect
     */
    public function withIncludeGuestCompletedVisitsCount(?bool $includeGuestCompletedVisitsCount): ReservationSelect
    {
        $this->includeGuestCompletedVisitsCount = $includeGuestCompletedVisitsCount;
        return $this;
    }

    /**
     * @return array
     */
    public function build(): array
    {
        $filter = [];
        if ($this->includeGuestProfile !== null) {
            $filter['IncludeGuestProfile'] = $this->includeGuestProfile;
        }
        if ($this->includeGuestPhones !== null) {
            $filter['IncludeGuestPhones'] = $this->includeGuestPhones;
        }
        if ($this->includeCustomFields !== null) {
            $filter['IncludeCustomFields'] = $this->includeCustomFields;
        }
        if ($this->includeDocumentData !== null) {
            $filter['IncludeDocumentData'] = $this->includeDocumentData;
        }
        if ($this->includeGuestCompletedVisitsCount !== null) {
            $filter['IncludeGuestCompletedVisitsCount'] = $this->includeGuestCompletedVisitsCount;
        }
        return $filter;
    }
}