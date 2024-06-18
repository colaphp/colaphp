<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Flame\Http\Request;
use Flame\Http\Response;

class IndexController extends BaseController
{
    public function index(Request $request): Response
    {
        return view('index', ['name' => 'ColaPHP', 'request' => $request->all()]);
    }

    public function json(Request $request): Response
    {
        return $this->success([
            'msg' => 'ok',
            'request' => $request->all(),
            'path' => $request->path(),
        ]);
    }

    public function file(Request $request): Response
    {
        $file = $request->file('upload');
        if ($file && $file->isValid()) {
            $file->move(public_path('storage/myfile.'.$file->getUploadExtension()));

            return $this->success(['msg' => 'upload success']);
        }

        return $this->success(['msg' => 'file not found']);
    }
}
