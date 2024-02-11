@extends('layouts.auth')

@section('title', __('auth.welcome'))

@section('content')
<div class="form-container">
        <h1>{{ __('auth.welcome') }}!</h1>
        <p>{{ __('auth.welcome_message') }}
        </p>
        <a href="{{ route('register') }}"><button>{{ __('auth.get_started') }}</button></a>
        <a href="{{ route('login') }}">{{ __('auth.have_an_account') }}</a>
</div>
@endsection