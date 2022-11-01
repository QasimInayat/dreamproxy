<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * @return Application|ResponseFactory|Response
     */
    function list()
    {
        $products = Product::where('status', 'ACTIVE')->get();
        return response($products);
    }
}
