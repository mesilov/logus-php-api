<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Services\GuestProfile\Result;

use Mesilov\Logus\Api\Core\Exceptions\BaseException;
use Mesilov\Logus\Api\Core\Result\AbstractResult;

class GuestProfilesResult extends AbstractResult
{
    /**
     * @return GuestProfileItem[]
     * @throws BaseException
     */
    public function getGuestProfiles(): array
    {
        $res = [];
        foreach ($this->getCoreResponse()->getResponseData()['Items'] as $guestProfile) {
            $res[] = new GuestProfileItem($guestProfile);
        }
        return $res;
    }
}