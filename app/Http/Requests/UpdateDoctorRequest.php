<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDoctorRequest extends FormRequest
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
            'name' => 'required|string',
            'address' => 'required|string',
            'phone' => 'required|string',
            'map' => 'required|string',
            'extra' => 'required|string',
            'city_id' => 'required',
            'major_id' => 'required',
            'photo' => 'required|image'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'حقل اسم السائق مطلوب.',
            'name.string' => 'حقل اسم السائق يجب أن يكون نصًا.',
            'address.required' => 'حقل العنوان مطلوب.',
            'address.string' => 'حقل العنوان  يجب أن يكون نصًا.',
            'phone.required' => 'حقل الهاتف مطلوب.',
            'phone.string' => 'حقل الهاتف يجب أن يكون رقما.',
            'map.required' => 'حقل  الخريطة مطلوب.',
            'map.string' => 'حقل الخريطة يجب أن يكون نصًا.',
            'extra.required' => 'حقل  المعلومات الاضافية مطلوب.',
            'extra.string' => 'حقل المعلومات الاضافية يجب أن يكون نصًا.',
            'city_id.required' => 'حقل المدينة مطلوب.',
            'major_id.required' => 'حقل التخصص مطلوب.',
            'photo.required' => 'حقل الصورة مطلوب.',
            'photo.image' => 'حقل الصورة يجب أن يكون صورة.',
        ];
    }
}
