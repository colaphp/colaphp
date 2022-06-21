<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Swift\Http\Request;
use Swift\Http\Response;

/**
 * Class Index
 * @package App\Http\Controllers\Web
 */
class IndexController extends Controller
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
        return view('view', ['name' => 'phpmall']);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function json(Request $request): Response
    {
        return $this->succeed(['msg' => 'ok']);
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
            return $this->succeed(['msg' => 'upload success']);
        }
        return $this->succeed(['msg' => 'file not found']);
    }
}
