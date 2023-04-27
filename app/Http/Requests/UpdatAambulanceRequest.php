<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatAambulanceRequest extends FormRequest
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
            'driver' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'counter' => 'required|string',
            'city_id' => 'required',
            'image' => 'required|image'
        ];
    }

    public function messages()
    {
        return [
            'driver.required' => 'حقل اسم السائق مطلوب.',
            'driver.string' => 'حقل اسم السائق يجب أن يكون نصًا.',
            'address.required' => 'حقل العنوان مطلوب.',
            'address.string' => 'حقل العنوان  يجب أن يكون نصًا.',
            'phone.required' => 'حقل الهاتف مطلوب.',
            'phone.string' => 'حقل الهاتف يجب أن يكون رقما.',
            'counter.required' => 'حقل  عدد مرات الخروج مطلوب.',
            'counter.string' => 'حقل عدد مرات الخروج يجب أن يكون نصًا.',
            'city_id.required' => 'حقل المدينة مطلوب.',
            'image.required' => 'حقل الصورة مطلوب.',
            'image.image' => 'حقل الصورة يجب أن يكون صورة.',
        ];
    }
}
