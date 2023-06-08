<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Services\GuestProfile;

use Generator;
use Mesilov\Logus\Api\Core\Contracts\CoreInterface;
use Mesilov\Logus\Api\Core\Exceptions\BaseException;
use Mesilov\Logus\Api\Core\Response\Response;
use Mesilov\Logus\Api\Services\AbstractService;
use Mesilov\Logus\Api\Services\Common\Pagination;
use Mesilov\Logus\Api\Services\GuestProfile\Result\GuestProfilesResult;
use Psr\Log\LoggerInterface;

readonly class GuestProfileFetcher
{
    public function __construct(
        protected GuestProfile    $guestProfile,
        protected LoggerInterface $log
    )
    {
    }

    /**
     * @throws BaseException
     */
    public function getList(GuestProfileFilter $guestProfileFilter): Generator
    {
        $pagination = Pagination::default();
        $cnt = 1;
        while (true) {
            $res = $this->guestProfile->search($guestProfileFilter, $pagination);
            foreach ($res->getGuestProfiles() as $guestProfile) {
                $this->log->debug('GuestProfileFetcher.getList.item', ['cnt' => $cnt, 'guestProfileGenericNo' => $guestProfile->GenericNo]);
                yield $cnt => $guestProfile;
                $cnt++;
            }
            if (count($res->getGuestProfiles()) === 0) {
                break;
            }
            $pagination = $pagination->getNextPage();
        }
    }
}