<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MentorRequest extends FormRequest
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
            'name' => ['required', 'min:3', 'max:40', 'regex:/^[a-zA-Z\s]+$/'],
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên.',
            'name.min' => 'Tên ít nhất phải :min ký tự.',
            'name.max' => 'Tên không được vượt quá :max ký tự.',
            'name.regex' => 'Tên không được chứa số hoặc kí tự đặc biệt.',
            ];
        }
}
