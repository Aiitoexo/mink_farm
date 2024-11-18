<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnimalRequest extends FormRequest
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
            'id' => ['integer', 'exists:animals,id'],
            'name' => ['required', 'string'],
            'type' => ['required', 'integer'],
            'breed' => ['required', 'integer'],
            'description' => ['required', 'string'],
            'age' => ['required', 'integer'],
            'status' => ['required', 'string'],
            'photos' => ['required', 'array'],
            'price' => ['required', 'numeric'],
        ];
    }
}
