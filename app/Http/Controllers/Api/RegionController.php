<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Model\Region;
use Swift\Http\Response;

/**
 * Class RegionController
 * @package App\Http\Controllers\Api
 */
class RegionController extends Controller
{
    public function index(): Response
    {
        $data = Region::limit(100)->get();
        return $this->succeed($data);
    }
}
