<?php

namespace App\Http\Requests;

use App\Rules\AlphaSpaces;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateUserProfile extends FormRequest
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
        $userId = Auth::id();
        return [
            'name' => [
                'required',
                'max:50',
                new AlphaSpaces()
            ],
            'email' => [
                'required',
                //'unique:users',
                Rule::unique('users')->ignore($userId),
                'email'
            ],
            'phone' => [
                'min:6',
            ],
              'avatar' => 'nullable|file|image',
        ];
    }

    public function messages()
    {
        return [
          'email.unique' => 'Ten email jest już zajety',
            'name.max' => 'Maksymalna zmakow to: :max'
        ];
    }
}
