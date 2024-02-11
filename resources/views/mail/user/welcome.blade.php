@component('mail::message')
# Welcome to {{ config('app.name') }}

Hi {{ $user->name }},

Thank you for registering with us.

@component('mail::button', ['url' => route('dashboard')])
Visit Site
@endcomponent

@endcomponent