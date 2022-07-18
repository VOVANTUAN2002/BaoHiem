<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required|unique:users',
            'password' => 'required',
            'user_group_id' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên nhân viên',
            'address.required' => 'Vui lòng nhập địa chỉ',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.unique' => 'Số điện thoại đã được đăng kí',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'user_group_id.required' => 'Vui lòng nhập nhóm nhân viên',
        ];
    }
}