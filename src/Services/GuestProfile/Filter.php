<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Services\GuestProfile;

class Filter
{
    /**
     * @var string|null Идентификатор профайла
     */
    private ?string $genericNo = null;
    private ?string $phone = null;
    /**
     * @var string|null  Фамилия
     */
    private ?string $lastName = null;
    /**
     * @var string|null Имя
     */
    private ?string $firstName = null;
    /**
     * @var string|null Отчество
     */
    private ?string $middleName = null;

//query	string
//filter.firstLetter
//Первая буква фамилии
//
//query	string
//filter.query
//Текстовый запрос
//
//query	string
//filter.includeClosed
//Показывать закрытые профили?
//query	boolean

//filter.fuzzySearch
//Нечёткий поиск
//query	boolean

//filter.companyProfileId
//Идентификатор профиля компании
//query	long


//query	string
//filter.birthDate
//Дата рождения
//
//query	date-time
//filter.documentNumber
//Номер документа
//
//query	string
//filter.skip
//Кол-во записей, которые следует "пропустить" при выдаче результата
//
//query	integer
//filter.limit
//Макс. число записей к выдаче
//
//query	integer
//filter.modifiedSince
//Выдаёт только те профили, которые были изменены не ранее указанного времени
//
//query	date-time
//filter.findMatchingProfiles
//Данный флаг определяет, что следует осуществить поиск похожих профилей
//
//query	boolean
//filter.tagIds
//Provide multiple values in new lines.
//query	Array[long]


    /**
     * Идентификатор профайла
     *
     * @param string|null $genericNo
     * @return Filter
     */
    public function withGenericNo(?string $genericNo): Filter
    {
        $this->genericNo = $genericNo;
        return $this;
    }

    /**
     * Телефон
     *
     * @param string $phone
     * @return Filter
     */
    public function withPhone(string $phone): Filter
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * Фамилия
     *
     * @param string $lastName
     * @return Filter
     */
    public function withLastName(string $lastName): Filter
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * Имя
     *
     * @param string $firstName
     * @return Filter
     */
    public function withFirstName(string $firstName): Filter
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * Отчество
     *
     * @param string $middleName
     * @return Filter
     */
    public function withMiddleName(string $middleName): Filter
    {
        $this->middleName = $middleName;
        return $this;
    }

    /**
     * @return array
     */
    public function build(): array
    {
        $filter = [];
        if ($this->genericNo !== null) {
            $filter['filter.genericNo'] = $this->genericNo;
        }
        if ($this->phone !== null) {
            $filter['filter.phone'] = $this->phone;
        }
        if ($this->lastName !== null) {
            $filter['filter.lastName'] = $this->lastName;
        }
        if ($this->firstName !== null) {
            $filter['filter.firstName'] = $this->firstName;
        }
        if ($this->middleName !== null) {
            $filter['filter.middleName'] = $this->middleName;
        }
        return $filter;
    }
}