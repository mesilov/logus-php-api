<?php

declare(strict_types=1);

namespace Mesilov\Logus\Api\Core\Result;

use ArrayIterator;
use Mesilov\Logus\Api\Core;
use IteratorAggregate;
use Traversable;

abstract class AbstractItem implements IteratorAggregate
{
    protected array $data;

    /**
     * AbstractItem constructor.
     *
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param int|string $offset
     *
     * @return bool
     */
    public function __isset(int|string $offset): bool
    {
        return isset($this->data[$offset]);
    }

    /**
     * @param int|string $offset
     *
     * @return mixed
     */
    public function __get(int|string $offset)
    {
        return $this->data[$offset] ?? null;
    }

    /**
     * @param int|string $offset
     * @param mixed      $value
     *
     * @return void
     * @throws Core\Exceptions\ImmutableResultViolationException
     *
     */
    public function __set(int|string $offset, mixed $value)
    {
        throw new Core\Exceptions\ImmutableResultViolationException(sprintf('Result is immutable, violation at offset %s', $offset));
    }

    /**
     * @param int|string $offset
     *
     * @throws Core\Exceptions\ImmutableResultViolationException
     */
    public function __unset(int|string $offset)
    {
        throw new Core\Exceptions\ImmutableResultViolationException(sprintf('Result is immutable, violation at offset %s', $offset));
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator():Traversable
    {
        return new ArrayIterator($this->data);
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    protected function isKeyExists(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }
}