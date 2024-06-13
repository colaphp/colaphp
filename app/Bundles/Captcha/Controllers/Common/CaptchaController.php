<?php

declare(strict_types=1);

namespace App\Bundles\Captcha\Controllers\Common;

use App\API\Common\Controllers\BaseController;
use App\Bundles\Captcha\Response\ImageCaptchaResponse;
use App\Bundles\Captcha\Services\CaptchaBundleService;
use Flame\Foundation\Exception\CustomException;
use Flame\Http\Response;
use Flame\Support\Facade\Log;
use Flame\Support\Str;
use OpenApi\Attributes as OA;
use Throwable;

class CaptchaController extends BaseController
{
    #[OA\Get(path: '/captcha', summary: '获取图片验证码', tags: ['验证码'])]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: ImageCaptchaResponse::class))]
    public function index(): Response
    {
        try {
            $uuid = Str::uuid()->toString();
            $captcha = (new CaptchaBundleService())->create($uuid);

            $captchaResponse = new ImageCaptchaResponse();
            $captchaResponse->setCaptcha($captcha);
            $captchaResponse->setUuid($uuid);

            return $this->success($captchaResponse->toArray());
        } catch (Throwable $e) {
            if ($e instanceof CustomException) {
                return $this->fail($e);
            }

            Log::error($e);

            return $this->fail('获取图片验证码错误');
        }
    }
}
