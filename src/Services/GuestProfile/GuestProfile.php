<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Services\GuestProfile;

use Mesilov\Logus\Api\Core\Contracts\CoreInterface;
use Mesilov\Logus\Api\Core\Exceptions\BaseException;
use Mesilov\Logus\Api\Core\Response\Response;
use Mesilov\Logus\Api\Services\AbstractService;
use Mesilov\Logus\Api\Services\Common\Pagination;
use Mesilov\Logus\Api\Services\GuestProfile\Result\GuestProfilesResult;

readonly class GuestProfile extends AbstractService
{
    /**
     * @param GuestProfileFilter $filter
     * @param Pagination|null $pagination
     * @return GuestProfilesResult
     */
    public function search(GuestProfileFilter $filter, ?Pagination $pagination = null): GuestProfilesResult
    {
        if ($pagination === null) {
            $pagination = Pagination::default();
        }
        return new GuestProfilesResult(
            $this->core->call('GET', 'GuestProfile/Search?' . http_build_query(
                    array_merge(
                        $filter->build(),
                        [
                            'filter.skip' => $pagination->skip,
                            'filter.limit' => $pagination->limit,
                        ]
                    )
                )
            )
        );
    }
}