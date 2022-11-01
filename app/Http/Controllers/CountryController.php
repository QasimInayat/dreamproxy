<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

class CountryController extends Controller
{
    /**
     * @return Application|ResponseFactory|Response
     */
    function list() {
        return response([
            Country::all()
        ]);
    }
}
