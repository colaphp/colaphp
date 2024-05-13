<?php

declare(strict_types=1);

namespace App\Procedures;

use Flame\JsonRpc\JsonRpcServer;
use Flame\JsonRpc\Procedure;

class TestProcedure extends JsonRpcServer implements Procedure
{
    public function create(array $params): array
    {
        return [];
    }
}
