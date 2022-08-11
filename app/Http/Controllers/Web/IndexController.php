<?php

declare(strict_types=1);

namespace App\Http\Controllers\Web;

use Cola\Http\Request;
use Cola\Http\Response;

class IndexController extends BaseController
{
    /**
     * @return Response
     */
    public function index(Request $request): Response
    {
        return view('index', ['name' => 'ColaPHP', 'request' => $request->all()]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function json(Request $request): Response
    {
        return $this->success(['msg' => 'ok', 'request' => $request->all()]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function file(Request $request): Response
    {
        $file = $request->file('upload');
        if ($file && $file->isValid()) {
            $file->move(public_path('storage/myfile.' . $file->getUploadExtension()));
            return $this->success(['msg' => 'upload success']);
        }
        return $this->success(['msg' => 'file not found']);
    }
}
