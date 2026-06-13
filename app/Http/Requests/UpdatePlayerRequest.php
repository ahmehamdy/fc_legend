<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePlayerRequest extends FormRequest
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
            'name' => 'sometimes|sometimes|max:255',
            'age' => 'sometimes|numeric|max:45|min:16',
            'number' => 'sometimes|numeric|exists:players,number|max:99|min:1',
            'position' => 'sometimes|string|max:255',
            'nationality' => 'sometimes|string|max:255',
            'bio' => 'sometimes|string',
            'height' => 'sometimes|numeric',
            'weight' => 'sometimes|numeric',
            'image' => 'sometimes|image|mimes:jpg,jpeg,png|max:2048'
        ];
    }
}
