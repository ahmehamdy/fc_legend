<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateMatch_eventRequest extends FormRequest
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
            'player_id' => 'required|exists:players,id',
            'type' => 'required|in:goal,own_goal,start_match,end_match,yellow_card,red_card,substitution',
            'team' => 'required|in:home,away',
            'minute' => 'required|integer|min:0|max:100',
            'related_player_id' => 'nullable|exists:players,id',
        ];
    }
}
