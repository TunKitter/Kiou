<?php

namespace App\Http\Requests;

use App\Http\Requests\AuthRequest;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
     *
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => $this->name ? ['required', 'max:40', 'regex:/[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]+$/'] : '',
            'username' => $this->username ? ['required', 'string', 'min:6', 'alpha_dash:ascii', Rule::unique('users')] : '',
            'phone' => $this->phone ? ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/', 'min:9', 'max:10'] : '',
            'email' => $this->email ? ['required', 'string', 'email', 'max:40', Rule::unique('users')] : '',
            'avatar' => $this->avatar ? ['image', 'mimes:png,jpg', 'max:2048'] : '',
        ];
    }
    public function messages()
    {
        return (new AuthRequest())->messages();
    }
    public function attributes()
    {
        return (new AuthRequest())->attributes();
    }
}
