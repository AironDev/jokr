<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'bio' => 'string|nullable',
            'location' => 'string|nullable',
            'job_title' => 'string|nullable',
            'gender' => 'string',
            'age' => 'string',
            'facebook' => 'string|nullable',
            'twitter' => 'string|nullable',
            'linkedin' => 'string|nullable',
            'instagram' => 'string|nullable',
            'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
            'cover_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable',
        ];
    }
}
