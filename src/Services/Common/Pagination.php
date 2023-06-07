<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Services\Common;

use Mesilov\Logus\Api\Core\Contracts\CoreInterface;

readonly class Pagination
{
    /**
     * @param int $skip
     * @param int $limit
     */
    public function __construct(
        private int $skip = 0,
        private int $limit = CoreInterface::API_RESPONSE_PAGE_SIZE)
    {
    }

    /**
     * @return array
     */
    public function build(): array
    {
        return [
            'filter.skip' => $this->skip,
            'filter.limit' => $this->limit,
        ];
    }

    /**
     * @return self
     */
    public static function default(): self
    {
        return new self();
    }
}