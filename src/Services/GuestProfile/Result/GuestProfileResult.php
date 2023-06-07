<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Services\GuestProfile\Result;

use Mesilov\Logus\Api\Core\Exceptions\BaseException;
use Mesilov\Logus\Api\Core\Result\AbstractResult;

class GuestProfileResult extends AbstractResult
{
    /**
     * @throws BaseException
     */
    public function getGuestProfile(): GuestProfileItem
    {
        return new GuestProfileItem($this->getCoreResponse()->getResponseData());
    }
}