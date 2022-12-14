<?php

namespace App\Http\Controllers;

use App\Models\Modem;
use App\Models\UsersModem;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class ModemController extends Controller
{

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    function changeIp(Request $request)
    {
        $request->validate([
            'modem_id' => 'required|exists:users_modem,id'
        ]);

        $userModem = UsersModem::where('modem_id', $request->input('modem_id'))
            ->where('user_id', Auth::id())
            ->with('modem')
            ->with('modem.server')
            ->firstOrFail();

        if($userModem->last_ip_change && Carbon::now()->diffInSeconds($userModem->last_ip_change) < 30) {
            return response([
                'error' => 'You can change ip 1 time every 30 seconds'
            ], 403);
        }

        if(!Modem::changeIp($userModem->modem)) {
            return response([
                'error' => 'An error occurred during the ip change. Try later'
            ], 403);
        };

        return response([], 200);

    }
}
