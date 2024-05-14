<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\MigrationRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class MigrationService extends CommonService implements ServiceInterface
{
    public function getRepository(): MigrationRepository
    {
        return MigrationRepository::getInstance();
    }
}
