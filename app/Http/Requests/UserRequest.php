<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UserRequest extends FormRequest
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
        if($request->isMethod('PUT')) {
            $rules = [
                'name'      => 'required',
                'email'     => 'required|email|unique:users,email,'.$request->id,
            ];

            if($request->password != '') {
                $rules['password']              = 'required|min:8|confirmed';
                $rules['password_confirmation'] = 'required';
            }

            return $rules;

        } else {
            return [
                'name'                  => 'required',
                'email'                 => 'required|email|unique:users,email',
                'password'              => 'required|min:8|confirmed',
                'password_confirmation' => 'required',
            ];
        }

    }
}
