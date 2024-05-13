<?php

declare(strict_types=1);

namespace App\API\User\Controllers;

use App\API\Common\Controllers\BaseController as Controller;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Contact;

#[OA\Info(version: '1.0', description: '会员接口', title: 'API文档', contact: new Contact('API Develop Team'))]
#[OA\Server(url: '/', description: '开发环境')]
abstract class BaseController extends Controller
{
}
