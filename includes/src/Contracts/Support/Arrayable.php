<?php

namespace Swift\Contracts\Support;

/**
 * Interface Arrayable
 * @package Swift\Contracts\Support
 */
interface Arrayable
{
    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array;
}
