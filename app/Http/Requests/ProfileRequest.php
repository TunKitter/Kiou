<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z]+$/'],
            'username' => ['required','string','min:6','alpha_dash:ascii',Rule::unique('users')],
            'phone' => ['required','regex:/^([0-9\s\-\+\(\)]*)$/','min:9','max:10'],
            'avatar' => ['image','mimes:png,jpg','max:2048'],
            'email' => ['required','string','email','max:40',Rule::unique('users'),],
            'password' => ['required','string','min:6',],
            'new_password' => ['required','string','min:6',],
            'cf_password' => ['required','string','min:6',],
        ];
    }
}
