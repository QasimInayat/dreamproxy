<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Stripe\StripeClient;

class ProductController extends Controller
{
    /**
     * @return Application|ResponseFactory|Response
     */
    function list()
    {
        $stripe = new StripeClient(env('STRIPE_SECRET_KEY'));
        $products = $stripe->prices->all([]);
        return response($products);
    }
}
