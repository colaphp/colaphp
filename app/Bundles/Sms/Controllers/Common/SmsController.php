<?php

declare(strict_types=1);

namespace App\Bundles\Sms\Controllers\Common;

use App\API\Common\Controllers\BaseController;
use App\Bundles\Sms\Controllers\Common\Requests\SmsSendRequest;
use App\Bundles\Sms\Enums\SmsErrorCodeEnum;
use App\Bundles\Sms\Services\SmsBundleService;
use Flame\Foundation\Exception\CustomException;
use Flame\Http\Response;
use Flame\Support\Facade\Log;
use Flame\Validation\Exception\ValidationException;
use OpenApi\Attributes as OA;
use Throwable;

class SmsController extends BaseController
{
    #[OA\Post(path: '/sms/send', summary: '发送手机短信验证码', tags: ['短信'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: SmsSendRequest::class))]
    #[OA\Response(response: 200, description: 'OK')]
    public function send(): Response
    {
        try {
            $request = $this->requestBody();

            $v = new SmsSendRequest();
            if (! $v->check($request)) {
                throw new ValidationException($v->getError());
            }

            $smsService = new SmsBundleService();
            $smsService->sendCode($request['mobile']);

            return $this->success('短信发送成功');
        } catch (Throwable $e) {
            if ($e instanceof CustomException || $e instanceof ValidationException) {
                return $this->fail($e);
            }

            Log::error($e);

            return $this->fail(SmsErrorCodeEnum::SMS_SEND_ERROR);
        }
    }
}
