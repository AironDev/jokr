<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleAndAbilityRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'role_name' => 'required|string',
            'role_title' => 'required|string',
            'role_description' => 'required|string',

            'ability_name' => 'required|string',
            'abiltity_title' => 'required|string',
            'ability_description' => 'required|string'
        ];
    }
}
