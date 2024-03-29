<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Service\OAuth\SocializeService;
use Cola\Http\Request;
use Cola\Http\Response;
use Cola\Log\Log;
use Exception;

class SocializeController extends Controller
{
    /**
     * 社会化授权登录
     *
     * @param  Request  $request
     * @return Response
     */
    public function redirect(Request $request): Response
    {
        $type = $request->get('type');

        try {
            $socializeService = new SocializeService();
            $url = $socializeService->redirect($type);

            return redirect($url);
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return redirect('/');
        }
    }

    /**
     * 社会化授权登录回调
     *
     * @param  Request  $request
     * @return Response
     */
    public function callback(Request $request): Response
    {
        $type = $request->get('type');
        $code = $request->get('code');

        try {
            $socializeService = new SocializeService();
            $user = $socializeService->callback($type, $code);
            // TODO && login or register
            return $user->getId();
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return redirect('/');
        }
    }
}
