<?php

declare(strict_types=1);

namespace App\API\Admin\Controllers;

use App\API\Common\Controllers\BaseController as Controller;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Contact;

#[OA\Info(version: '1.0', description: '管理平台', title: 'API文档', contact: new Contact('API Develop Team'))]
#[OA\Server(url: '/api/v1/admin', description: '开发环境')]
#[OA\SecurityScheme(securityScheme: 'bearerAuth', type: 'http', description: 'JWT 认证信息', name: 'Authorization', in: 'header', bearerFormat: 'JWT', scheme: 'bearer')]
abstract class BaseController extends Controller
{
}
