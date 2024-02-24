<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientAuthController extends Controller
{
    public function login()
    {
        return view('clients.login');
    }

    public function handleLogin(Request $req)
    {
        if(Auth::guard('client')
               ->attempt($req->only(['email', 'password'])))
        {
            return redirect()
                ->route('clients.home');
        }

        return redirect()
            ->back()
            ->with('error', 'Invalid Credentials');
    }

    public function logout()
    {
        Auth::guard('client')
            ->logout();

        return redirect()
            ->route('clients.login');
    }
}
