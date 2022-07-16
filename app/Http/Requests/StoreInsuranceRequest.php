<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInsuranceRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'contract' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'description' => 'required',
            'contract_package' => 'required',
            'total' => 'required',
            'unit' => 'required',
            'paid_and_unpaid_amount' => 'required',
        ];
    }
    public function messages()
    {
        $messages = [
            'required' => 'Trường này là bắt buộc',
        ];
        return $messages;
    }
}
