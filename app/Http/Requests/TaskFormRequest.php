<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskFormRequest extends FormRequest
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
        $rulesForm = [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'list' => ['nullable', 'integer', 'exists:listas,id'],
            'due_date' => ['nullable', 'date', 'after:today'],
            'completed' => ['nullable', 'boolean'],
            'priority' => ['nullable', 'integer', 'between:0,2'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['nullable', 'integer', 'exists:tags,id'],
            'status' => ['nullable', 'integer', 'between:0,3'],
        ];

        $rulesSearch = [
            'index' => ['nullable', 'integer', 'min:0'],
            'column' => ['nullable', 'string', 'in:to-do,in-progress,done'],
            'search' => ['nullable', 'string'],
            'list' => ['nullable', 'integer', 'exists:listas,id'],
        ];

        return $this->is('tasks/search') ? $rulesSearch : $rulesForm;
    }

    public function attributes(): array
    {
        return [
            'title' => __('validation.attributes.title'),
            'description' => __('validation.attributes.description'),
            'list' => __('validation.attributes.list'),
            'due_date' => __('validation.attributes.due_date'),
            'completed' => __('validation.attributes.completed'),
            'priority' => __('validation.attributes.priority'),
            'tags' => __('validation.attributes.tags'),
            'status' => __('validation.attributes.status'),
            'index' => __('validation.attributes.index'),
            'column' => __('validation.attributes.column'),
            'search' => __('validation.attributes.search'),
        ];
    }
}
