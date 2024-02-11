<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFormRequest;
use Illuminate\Support\Facades\Session;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserWelcome;

class RegisterController extends Controller
{
        public function show()
        {
                return view('auth.register');
        }

        public function register(UserFormRequest $request, UserRepository $repository)
        {
                $data = $request->validated();

                $user = $repository->create($data);

                Auth::login($user);

                Session::put('user', $user);

                // Mail::to($user)->send(new UserWelcome($user));

                return to_route('dashboard');
        }
}
