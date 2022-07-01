<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use Cola\Http\Request;
use Cola\Http\Response;

/**
 * Class Index
 * @package App\Http\Controllers\Web
 */
class IndexController extends BaseController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return view('index');
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function view(Request $request): Response
    {
        return view('view', ['name' => 'ColaPHP']);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function json(Request $request): Response
    {
        return $this->success(['msg' => 'ok']);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function file(Request $request): Response
    {
        $file = $request->file('upload');
        if ($file && $file->isValid()) {
            $file->move(public_path() . '/files/myfile.' . $file->getUploadExtension());
            return $this->success(['msg' => 'upload success']);
        }
        return $this->success(['msg' => 'file not found']);
    }
}
