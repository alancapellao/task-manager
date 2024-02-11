@extends('layouts.auth')

@section('title', __('auth.register'))

@section('content')

<div class="form-container">
        <h1>{{ __('auth.register') }}</h1>

        <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="form-group">
                        <input type="text" name="name" placeholder="{{ __('auth.name') }}" @error('name')
                                class="input-error" autofocus @enderror value="{{ old('name') }}">

                        @error('name')
                        <span class="error-arrow">{{ $message }}</span>
                        @enderror
                </div>
                <div class="form-group">
                        <input type="" name="username" placeholder="{{ __('auth.placeholder_username') }}"
                                @error('username') class="input-error" autofocus @enderror value="{{ old('username') }}">

                        @error('username')
                        <span class="error-arrow">{{ $message }}</span>
                        @enderror
                </div>
                <div class="form-group">
                        <input type="email" name="email" placeholder="Email" @error('email') class="input-error"
                                autofocus @enderror value="{{ old('email') }}">

                        @error('email')
                        <span class="error-arrow">{{ $message }}</span>
                        @enderror
                </div>
                <div class="form-group">
                        <div class="password-input-container">
                                <input type="password" id="password" name="password"
                                        placeholder="{{ __('auth.password') }}" @error('password') class="input-error"
                                        autofocus @enderror>
                                @include('partials.password_toggle')

                                @error('password')
                                <span class="error-arrow">{{ $message }}</span>
                                @enderror
                        </div>
                </div>
                <div class="form-group">
                        <input type="password" name="password_confirmation"
                                placeholder="{{ __('auth.confirm_password') }}" @error('password')
                                class="input-error" autofocus @enderror>
                </div>

                <button>{{ __('auth.register') }}</button>
        </form>

        <a href="{{ route('login') }}">{{ __('auth.have_an_account') }}</a>
</div>
@endsection