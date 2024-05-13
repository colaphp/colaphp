<?php

declare(strict_types=1);

namespace App\Http\Controllers\User;

use Flame\Routing\Controller;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Contact;

#[OA\Info(version: '1.0', description: '用户平台', title: 'API文档', contact: new Contact('API Develop Team'))]
#[OA\Server(url: 'http://127.0.0.1:8000/', description: '开发环境')]
abstract class BaseController extends Controller
{
}
