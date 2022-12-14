<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{

    /**
     * Registrazione di un nuovo utente
     * @return Application|ResponseFactory|Response
     * @throws \Stripe\Exception\ApiErrorException
     */
    function register(Request $request)
    {

        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
            'privacy' => 'required|boolean',
            'terms' => 'required|boolean',
        ]);

        // Creazione account utente
        $token = Str::random(64);
        $user = new User();
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->ipaddr = $request->ip();
        $user->status = 'ACTIVE';
        $user->level = 'USER';
        $user->api_token = $token;
        $user->save();

        return response([
            'token' => $token
        ]);
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    function login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (!Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'status' => 'ACTIVE'
        ])) {
            return response([
                'error' => 'Invalid username and/or password'
            ], 403);
        }

        $user = User::where('email', $request->input('email'))->firstOrFail();
        return response([
            'token' => $user->api_token
        ]);
    }

    /**
     * @return Application|ResponseFactory|Response
     */
    function profile()
    {
        $user = Auth::user();
        return response([
            'email' => $user->email
        ]);
    }

    /**
     * @return Application|ResponseFactory|Response
     */
    function listModem()
    {
        return response([
            Auth::user()->modem
        ]);
    }

    /**
     * @param Request $request
     * @return Application|Response|ResponseFactory
     */
    function lostPassword(Request $request)
    {

        $request->validate([
            'email' => 'required|exists:users,email',
        ]);

        $user = User::where('email', $request->input('email'))->first();
        if (!$user) {
            return response([]);
        }

        $user->password_recovery_token = Str::random(64);
        $user->save();

        Mail::send('mails/lostPassword', [
            'link' => env('APP_URL') . '/recoveryPassword/' . $user->password_recovery_token
        ], function ($message) use ($user) {
            $message
                ->to($user->email)
                ->from('noreply@dreamproxy.it')
                ->subject('Password recovery for DreamProxy');
        });

        return response([]);
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    function changePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:8'
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response([]);
    }

    /**
     * @param Request $request
     * @return Application|ResponseFactory|Response
     */
    function confirmLostPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required|confirmed|min:8',
            'password_recovery_token' => 'required|string'
        ]);

        $user = User::where('email', $request->input('email'))
            ->where('password_recovery_token', $request->input('password_recovery_token'))
            ->first();

        if (!$user) {
            return response([
                'error' => 'Invalid email and/or recovery token'
            ], 403);
        }

        $user->password = Hash::make($request->input('password'));
        $user->password_recovery_token = null;
        $user->save();

        return response([]);
    }
}
