<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreatePlayerRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'age' => 'required|numeric|max:45|min:16',
            'number' => 'required|unique:players,number|numeric|max:99|min:1',
            'position' => 'required|string|max:255',
            'nationality' => 'required|string|max:255',
            'bio' => 'required|string',
            'height' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048'
        ];
    }
}
