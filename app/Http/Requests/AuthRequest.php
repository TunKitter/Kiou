<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthRequest extends FormRequest
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
        $login_rules = [
            'email' => 'required|email',
            'password' => 'required|min:5',
        ];
        switch ($this->path()) {
            case 'login':
                return $login_rules;
            case 'register':
                return array_merge($login_rules, [
                    'name' => ['required', 'min:3', 'max:40', 'regex:/[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]+$/'],
                    'phone' => ['required', 'string', 'alpha_dash:ascii', Rule::unique('users'), 'regex:/^0\d{9}$/'],
                    'username' => [
                        'required',
                        'string',
                        'min:6',
                        'alpha_dash:ascii',
                        Rule::unique('users'),
                    ],

                    'email' => [
                        'email',
                        'required',
                        'string',
                        'max:40',
                        Rule::unique('users'),
                    ],
                    'password' => [
                        'regex:/[!@#$%^&*()_+{}\[\]:;<>,.?~\\/\|]/',
                        'required',
                        'string',
                        'min:6',
                    ],
                ]);
        }

    }
    public function messages(): array
    {
        return [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ!',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải chứa ít nhất :min ký tự!',
            'password.regex' => 'Mật khẩu phải chứa 1 ký tự đặc biệt!',
            'name.required' => 'Vui lòng nhập tên.',
            'name.min' => 'Tên ít nhất phải :min ký tự!',
            'name.max' => 'Tên không được vượt quá :max ký tự!',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'phone.regex' => 'Số điện thoại không hợp lệ phải bắt đầu từ 0!',
            'username.required' => 'Vui lòng nhập tên đăng nhập.',
            'username.min' => 'Tên đăng nhập phải chứa ít nhất :min ký tự!',
            'username.max' => 'Tên đăng nhập không được vượt quá :max ký tự!',
            'username.unique' => 'Username đã tồn tại trong hệ thống!',
            'username.max' => 'Tên đăng nhập không được vượt quá :max ký tự!',
            'email.max' => 'Địa chỉ email không được vượt quá :max ký tự!',
            'email.unique' => 'Địa chỉ email đã tồn tại trong hệ thống!',
            'phone.unique' => 'Số điện thoại đã tồn tại trong hệ thống!',
            '*.alpha_dash' => ':attribute không được chứa ký tự đặc biệt!',
            'name.regex' => ':attribute không được chứa ký tự đặc biệt!',

        ];
    }
    public function attributes(): array
    {
        return [
            'name' => 'Tên',
            'email' => 'Địa chỉ email',
            'phone' => 'Số điện thoại',
            'username' => 'Tên đăng nhập',
            'password' => 'Mật khẩu',
        ];
    }
}
