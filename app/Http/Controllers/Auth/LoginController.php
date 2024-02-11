<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
        public function __construct()
        {
                $this->middleware('guest')->except('logout');
        }

        public function show()
        {
                return view('auth.login');
        }

        public function login(LoginFormRequest $request)
        {
                $credentials = $request->only('email', 'password');

                if (!Auth::attempt($credentials)) {
                        return redirect()->back()
                                ->withErrors(['email' => __('auth.failed')])
                                ->withInput($request->only('email'));
                }

                $request->session()->regenerate();

                Session::put('user', Auth::user());

                return redirect()->intended('/dashboard');
        }

        public function logout(Request $request)
        {
                Auth::logout();

                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return to_route('welcome');
        }
}
