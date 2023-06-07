<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Core\Result;


use Mesilov\Logus\Api\Core\Response\Response;

abstract class AbstractResult
{
    protected Response $coreResponse;

    /**
     * AbstractResult constructor.
     *
     * @param Response $coreResponse
     */
    public function __construct(Response $coreResponse)
    {
        $this->coreResponse = $coreResponse;
    }

    /**
     * @return Response
     */
    public function getCoreResponse(): Response
    {
        return $this->coreResponse;
    }
}