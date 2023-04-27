<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
            'name' => 'required|string',
            'email' => 'required|email',
            'new_password' => 'required|string|min:8',
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => 'هذا المدير مدخل مسبقاً.',
            'name.required' => 'حقل اسم المدير مطلوب.',
            'name.string' => 'حقل اسم المدير يجب أن يكون نصًا.',
            'email.required' => 'حقل البريد الإلكتروني مطلوب.',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح.',
            'new_password.required' => 'حقل كلمة المرور مطلوب.',
            'new_password.min' => 'كلمة المرور قصيرة جدًا.',
        ];
    }
}
