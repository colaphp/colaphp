<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\DictOptionRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class DictOptionService extends CommonService implements ServiceInterface
{
    public function getRepository(): DictOptionRepository
    {
        return DictOptionRepository::getInstance();
    }
}
