<?php

declare(strict_types=1);

namespace App\Bundles\Article\Controllers\Admin;

use App\API\Admin\Controllers\BaseController;
use App\Bundles\Article\Requests\ArticleCreateRequest;
use App\Bundles\Article\Responses\ArticleResponse;
use App\Bundles\Article\Services\ArticleBundleService;
use Flame\Foundation\Exception\CustomException;
use Flame\Http\Response;
use Flame\Support\Facade\Log;
use OpenApi\Attributes as OA;
use Throwable;

class ArticleController extends BaseController
{
    #[OA\Post(path: '/article/manager/article/index', summary: '创建文章接口', tags: ['文章管理'])]
    #[OA\RequestBody(required: true, content: new OA\JsonContent(ref: ArticleCreateRequest::class))]
    #[OA\Response(response: 200, description: 'OK', content: new OA\JsonContent(ref: ArticleResponse::class))]
    public function index(): Response
    {
        try {
            $articleService = new ArticleBundleService();

            return $this->success(__FILE__);
        } catch (CustomException $e) {
            return $this->fail($e->getMessage());
        } catch (Throwable $e) {
            Log::error($e);

            return $this->fail($e->getMessage());
        }
    }
}
