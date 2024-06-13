<?php

declare(strict_types=1);

namespace App\Bundles\System\Controllers\Admin;

use App\API\Admin\Controllers\BaseController;
use Flame\Foundation\Exception\CustomException;
use Flame\Http\Response;
use Flame\Support\Facade\Log;

class IndexController extends BaseController
{
    #[OA\Post(path: '/admin', summary: '管理控制台', security: [['bearerAuth' => []]], tags: ['控制台'])]
    #[OA\Response(response: 200, description: 'OK')]
    public function index(): Response
    {
        try {
            return $this->success('manager');
        } catch (CustomException $e) {
            return $this->fail($e->getMessage());
        } catch (Throwable $e) {
            Log::error($e);

            return $this->fail('获取错误');
        }
    }
}
