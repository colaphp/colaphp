<?php

declare(strict_types=1);

namespace App\Support;

use Illuminate\Support\Collection;

abstract class ArrayObject
{
    /**
     * Get a collection containing the underlying array.
     *
     * @return Collection
     */
    public function collect(): Collection
    {
        return collect($this->toArray());
    }

    /**
     * Get the instance as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $attributes = [];
        foreach ($this as $key => $value) {
            $attributes[$key] = $value;
        }

        return $attributes;
    }

    /**
     * Get the instance as a json.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson(int $options = JSON_UNESCAPED_UNICODE): string
    {
        return json_encode($this->toArray(), $options);
    }
}
