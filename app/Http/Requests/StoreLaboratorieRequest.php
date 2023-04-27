<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLaboratorieRequest extends FormRequest
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
            'telephone' => 'required|string',
            'map' => 'required|string',
            'extra' => 'required|string',
            'city_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'حقل اسم المختبر مطلوب.',
            'name.string' => 'حقل اسم المختبر يجب أن يكون نصًا.',
            'address.required' => 'حقل العنوان مطلوب.',
            'address.string' => 'حقل العنوان  يجب أن يكون نصًا.',
            'phone.required' => 'حقل رقم الهاتف مطلوب.',
            'phone.string' => 'حقل رقم الهاتف يجب أن يكون رقما.',
            'map.required' => 'حقل  الخريطة مطلوب.',
            'map.string' => 'حقل الخريطة يجب أن يكون نصًا.',
            'telephone.required' => 'حقل  الهاتف الارضي مطلوب.',
            'telephone.string' => 'حقل الهاتف الارضي يجب أن يكون رقما ا.',
            'extra.required' => 'حقل المعلومات الاضافية الخروج مطلوب.',
            'extra.string' => 'حقل المعلومات الاضافية يجب أن يكون نصًا.',
            'city_id.required' => 'حقل المدينة مطلوب.'
        ];
    }
}
