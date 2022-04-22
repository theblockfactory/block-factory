<?php

namespace BlockFactory\Framework\Contracts;

/**
 * @since 1.0.0
 */
interface Arrayable
{
    /**
     * Get the instance as an array.
     * @return array
     */
    public function toArray(): array;
}
