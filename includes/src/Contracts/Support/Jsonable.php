<?php

namespace Swift\Contracts\Support;

/**
 * Interface Jsonable
 * @package Swift\Contracts\Support
 */
interface Jsonable
{
    /**
     * Convert the object to its JSON representation.
     *
     * @param int $options
     * @return string
     */
    public function toJson(int $options = 0): string;
}
