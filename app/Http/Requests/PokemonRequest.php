<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PokemonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'identifier' => 'required|unique:pokemon|max:255',
            'species_id' => 'required|integer',
            'height' => 'required|integer',
            'weight' => 'required|integer',
            'base_experience' => 'required|integer',
            'order' => 'required|integer',
            'legendary' => 'required|boolean',
        ];
    }
}
