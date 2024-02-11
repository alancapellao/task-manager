@extends('layouts.auth')

@section('title', __('auth.login'))

@section('content')
<div class="form-container">
        <h1>{{ __('auth.login') }}</h1>

        <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                        <input type="email" name="email" placeholder="{{ __('auth.email_placeholder_login') }}"
                                @error('email') class="input-error" autofocus @enderror value="{{ old('email') }}">

                        @error('email')
                        <span class="error-arrow">{{ $message }}</span>
                        @enderror
                </div>
                <div class="form-group">

                        <input type="password" id="password" name="password" placeholder="{{ __('auth.password') }}"
                                @error('password') class="input-error" autofocus @enderror>
                        @include('partials.password_toggle')

                        @error('password')
                        <span class="error-arrow">{{ $message }}</span>
                        @enderror
                </div>

                <button>{{ __('auth.login') }}</button>
        </form>

        <a href="{{ route('register') }}">{{ __('auth.no_account') }}</a>
</div>
@endsection