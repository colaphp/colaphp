<?php

declare(strict_types=1);

namespace App\Http\Responses;

abstract class Transformer
{
    public function transformCollection($data): array
    {
        return array_map([$this, 'transform'], $data);
    }

    abstract public function transform($item): mixed;
}
