<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Core\Response;

use Mesilov\Logus\Api\Core\Exceptions\BaseException;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use Throwable;

class Response
{
    private ?array $result = null;

    public function __construct(
        private readonly ResponseInterface $httpResponse,
        private readonly LoggerInterface   $logger)
    {
    }

    /**
     * @return ResponseInterface
     */
    public function getHttpResponse(): ResponseInterface
    {
        return $this->httpResponse;
    }

    public function getResponseData(): array
    {
        $this->logger->debug('getResponseData.start');

        if ($this->result === null) {
            try {
                $this->logger->debug('getResponseData.parseResponse.start');
                $this->result = $this->httpResponse->toArray(true);
                $this->logger->info('getResponseData.responseBody', [
                    'responseBody' => $this->result,
                ]);
                // try to handle api-level errors
                $this->handleApiLevelErrors($this->result);
                $this->logger->debug('getResponseData.parseResponse.finish');
            } catch (Throwable $exception) {
                $this->logger->error(
                    $exception->getMessage(),
                    [
                        'response' => $this->getHttpResponseContent(),
                    ]
                );
                throw new BaseException(sprintf('api request error: %s', $exception->getMessage()), $exception->getCode(), $exception);
            }
        }
        $this->logger->debug('getResponseData.finish');

        return $this->result;
    }

    /**
     * @return string|null
     */
    private function getHttpResponseContent(): ?string
    {
        $content = null;
        try {
            $content = $this->httpResponse->getContent(false);
        } catch (Throwable $exception) {
            $this->logger->error($exception->getMessage());
        }

        return $content;
    }

    /**
     * @param array $apiResponse
     */
    private function handleApiLevelErrors(array $apiResponse): void
    {
        $this->logger->debug('handleApiLevelErrors.start');

        if (array_key_exists('error', $apiResponse)) {
            $errorMsg = sprintf(
                '%s - %s ',
                $apiResponse['error'],
                (array_key_exists('error_description', $apiResponse) ? $apiResponse['error_description'] : ''),
            );
        }
        $this->logger->debug('handleApiLevelErrors.finish');
    }
}