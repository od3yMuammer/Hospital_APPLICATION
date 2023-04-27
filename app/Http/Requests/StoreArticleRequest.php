<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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

    /**language_name
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'details' => 'required|string',
            'counter' => 'required|string',
            'categore_id' => 'required',
            'image' => 'required|image'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'حقل العنوان مطلوب.',
            'title.string' => 'حقل العنوان يجب أن يكون نصًا.',
            'details.required' => 'حقل التفاصيل مطلوب.',
            'details.string' => 'حقل التفاصيل  يجب أن يكون نصًا.',
            'counter.required' => 'حقل  عدد مرات الظهور مطلوب.',
            'counter.string' => 'حقل عدد مرات الظهور يجب أن يكون نصًا.',
            'categore_id.required' => 'حقل الفئة مطلوب.',
            'image.required' => 'حقل الصورة مطلوب.',
            'image.image' => 'حقل الصورة يجب أن يكون صورة.',
        ];
    }
}
