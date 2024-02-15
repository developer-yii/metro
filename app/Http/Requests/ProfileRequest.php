<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProfileRequest extends FormRequest
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
    public function rules(Request $request): array
    {

        $rules = [
            'name'        => 'required',
            'email'       => 'required|email|unique:users,email,'. auth()->user()->id,
            'profile_pic' => 'mimes:jpeg,png,jpg,gif,svg|max:5000',
        ];

        return $rules;

    }
}
