<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|unique:tasks|max:255',
        ];
    }

    public function prepareForValidation()
    {
        $trimmedInputs = array_map(function ($value) {
            return is_string($value) ? trim($value) : $value;
        }, $this->json()->all());
        $this->merge($trimmedInputs);
    }
}
