<?php

declare(strict_types=1);

namespace App\Bundles\Captcha\Response;

use Flame\Support\ArrayHelper;
use OpenApi\Attributes as OA;

#[OA\Schema(schema: 'ImageCaptchaResponse')]
class ImageCaptchaResponse
{
    use ArrayHelper;

    #[OA\Property(property: 'captcha', description: '图片验证码', type: 'string')]
    private string $captcha;

    #[OA\Property(property: 'uuid', description: '图片验证码UUID', type: 'string')]
    private string $uuid;

    public function setCaptcha(string $captcha): void
    {
        $this->captcha = $captcha;
    }

    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }
}
