<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Core;

use Fig\Http\Message\StatusCodeInterface;
use Mesilov\Logus\Api\Core\Contracts\ApiClientInterface;
use Mesilov\Logus\Api\Core\Contracts\CoreInterface;
use Mesilov\Logus\Api\Core\Exceptions\BaseException;
use Mesilov\Logus\Api\Core\Exceptions\InvalidArgumentException;
use Mesilov\Logus\Api\Core\Exceptions\TransportException;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

readonly class Core implements CoreInterface
{
    public function __construct(
        protected ApiClientInterface $apiClient,
        protected LoggerInterface    $logger)
    {
    }

    /**
     * @throws InvalidArgumentException
     * @throws BaseException
     * @throws TransportException
     */
    public function call(string $httpMethod, string $apiMethod, array $parameters = []): Response\Response
    {
        $this->logger->debug(
            'call.start',
            [
                'httpMethod' => $httpMethod,
                'method' => $apiMethod,
                'parameters' => $parameters,
            ]
        );

        $response = null;
        try {
            // make async request
            $apiCallResponse = $this->apiClient->getResponse($httpMethod, $apiMethod, $parameters);
            $this->logger->debug(
                'call.responseInfo',
                [
                    'httpStatus' => $apiCallResponse->getStatusCode(),
                ]
            );
            switch ($apiCallResponse->getStatusCode()) {
                case StatusCodeInterface::STATUS_OK:
                    //todo check with empty response size from server
                    $response = new Response\Response($apiCallResponse, $this->logger);
                    break;
                case StatusCodeInterface::STATUS_UNAUTHORIZED:
                    $body = $apiCallResponse->toArray(false);
                    $this->logger->debug(
                        'UNAUTHORIZED request',
                        [
                            'body' => $body,
                        ]
                    );
                    throw new BaseException('UNAUTHORIZED request error');
                case StatusCodeInterface::STATUS_SERVICE_UNAVAILABLE:
                    $body = $apiCallResponse->toArray(false);
                    $this->logger->notice(
                        'service unavailable',
                        [
                            'body' => $body,
                        ]
                    );
                    throw new BaseException('service unavailable');
                default:
                    $body = $apiCallResponse->toArray(false);
                    $this->logger->notice(
                        'unhandled server status',
                        [
                            'httpStatus' => $apiCallResponse->getStatusCode(),
                            'body' => $body,
                        ]
                    );
                    throw new BaseException('unhandled server status');
            }
        } catch (TransportExceptionInterface $exception) {
            // catch symfony http client transport exception
            $this->logger->error(
                'call.transportException',
                [
                    'trace' => $exception->getTrace(),
                    'message' => $exception->getMessage(),
                ]
            );
            throw new TransportException(sprintf('transport error - %s', $exception->getMessage()), $exception->getCode(), $exception);
        } catch (BaseException $exception) {
            // rethrow known exception
            throw $exception;
        } catch (\Throwable $exception) {
            $this->logger->error(
                'call.unknownException',
                [
                    'message' => $exception->getMessage(),
                    'trace' => $exception->getTrace(),
                ]
            );
            throw new BaseException(sprintf('unknown error - %s', $exception->getMessage()), $exception->getCode(), $exception);
        }
        $this->logger->debug('call.finish');

        return $response;
    }

    public function getApiClient(): ApiClientInterface
    {
        return $this->apiClient;
    }
}