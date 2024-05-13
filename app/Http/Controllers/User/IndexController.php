<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use App\Exceptions\CustomException;
use Flame\Http\Response;
use Flame\Support\Facade\Log;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Contact;

/**
 * Class IndexController
 */
class IndexController extends BaseController
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return view('index');
    }

    #[OA\Get(path: '/user', summary: '获取用户信息', tags: ['用户信息'])]
    #[OA\Response(response: 200, description: 'OK')]
    public function user(): Response
    {
        try {
            return $this->success('user server');
        } catch (CustomException $e) {
            return $this->fail($e->getMessage());
        } catch (\Throwable $e) {
            Log::error($e);

            return $this->fail('发送错误');
        }
    }
}
