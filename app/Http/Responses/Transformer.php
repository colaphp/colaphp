<?php

declare(strict_types=1);

namespace App\Http\Responses;

/**
 * Class Transformer
 */
abstract class Transformer
{
    /**
     * @param $data
     * @return array
     */
    public function transformCollection($data): array
    {
        return array_map([$this, 'transform'], $data);
    }

    /**
     * @param $item
     * @return mixed
     */
    abstract public function transform($item);
}
