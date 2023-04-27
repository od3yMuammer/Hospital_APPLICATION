<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoreRequest extends FormRequest
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
            'picture' => 'required|image'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'حقل اسم الفئة مطلوب.',
            'name.string' => 'حقل اسم الفئة يجب أن يكون نصًا.',
            'picture.required' => 'حقل الصورة مطلوب.',
            'picture.image' => 'حقل الصورة يجب أن يكون صورة.',
        ];
    }
}
