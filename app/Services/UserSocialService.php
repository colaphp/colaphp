<?php

declare(strict_types=1);

namespace App\Services;

use App\Repositories\UserSocialRepository;
use Flame\Database\Contracts\ServiceInterface;
use Flame\Database\Services\CommonService;

class UserSocialService extends CommonService implements ServiceInterface
{
    public function getRepository(): UserSocialRepository
    {
        return UserSocialRepository::getInstance();
    }
}
