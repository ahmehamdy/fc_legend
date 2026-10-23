<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateFixtureRequest extends FormRequest
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
            'opponent' => ['sometimes', 'string', 'max:255'],
            'match_date' => ['sometimes', 'date'],
            'league' => ['sometimes', 'string', 'max:255'],
            'status' => ['sometimes',Rule::in(['upcoming'])],
        ];
    }
}
