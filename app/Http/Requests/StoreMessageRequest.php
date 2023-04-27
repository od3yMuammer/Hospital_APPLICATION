<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
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
            'sender_name' => 'required|string',
            'sender_email' => 'required|email',
            'sender_phone' => 'required|string|min:5',
            'message_text' => 'required|min:10',
        ];
    }
    public function messages()
    {
        return [
            'sender_name.required' => 'حقل اسم المرسل مطلوب.',
            'sender_name.string' => 'حقل اسم المرسل يجب أن يكون نصًا.',

            'sender_email.required' => 'حقل البريد الإلكتروني مطلوب.',
            'sender_email.email' => 'يرجى إدخال بريد إلكتروني صحيح.',

            'sender_phone.required' => 'حقل رقم المحمول مطلوب.',
            'sender_phone.min' => 'رقم المحمول قصير جدًا.',

            'message_text.required' => 'حقل نص الرسالة مطلوب.',
            'message_text.text' => 'حقل نص الرسالة يجب أن يكون نصًا.',
            'message_text.min' => 'نص الرسالة قصير جدًا.',
        ];
    }
}
