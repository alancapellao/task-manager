<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ListaFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function listaId()
    {
        return $this->route('list');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', Rule::unique('listas', 'name')->ignore($this->listaId())],
            'description' => ['nullable', 'string'],
            'color' => ['required', 'string', 'max:10'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('validation.attributes.name'),
            'description' => __('validation.attributes.description'),
            'color' => __('validation.attributes.color'),
        ];
    }
}
