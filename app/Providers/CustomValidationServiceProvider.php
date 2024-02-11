<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class CustomValidationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Validator::extend('valid_username', function ($attribute, $value, $parameters, $validator) {
            return strpos($value, '@') === 0;
        });

        Validator::replacer('valid_username', function ($message, $attribute, $rule, $parameters) {
            return __('validation.valid_username', ['attribute' => $attribute]);
        });
    }
}
