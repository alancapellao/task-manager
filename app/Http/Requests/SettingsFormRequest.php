<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingsFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'profile_photo' => ['nullable', 'image', 'max:1024'],
            'theme' => ['string', 'in:light,dark'],
            'language' => ['string', 'in:en,pt-BR'],
        ];
    }

    public function attributes()
    {
        return [
            'profile_photo' => __('validation.attributes.profile_photo'),
            'theme' => __('validation.attributes.theme'),
            'language' => __('validation.attributes.language'),
        ];
    }
}
