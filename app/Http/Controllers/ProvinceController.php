<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Response;

class ProvinceController extends Controller
{
    /**
     * @return Application|\Illuminate\Contracts\Routing\ResponseFactory|Response
     */
    function list() {
        return response([
            Province::all()
        ]);
    }
}
