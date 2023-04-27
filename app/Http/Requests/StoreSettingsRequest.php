<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSettingsRequest extends FormRequest
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
            'facebook' => 'required',
            'youtube' => 'required',
            'whatsapp' => 'required',
            'instagram' => 'required',
            'telegram' => 'required',
            'logo' => 'required|image'
        ];
    }

    public function messages()
    {
        return [
            'facebook.required' => 'حقل الفيسبوك مطلوب',
//            'facebook.url' => 'حقل الفيسبوك يجب ان يكون رابطا مبدؤا ب ://https',
            'youtube.required' => 'حقل اليوتيوب مطلوب',
//            'youtube.url' => 'حقل اليوتيوب يجب ان يكون رابطا مبدؤا ب ://https',
            'whatsapp.required' => 'حقل الواتساب مطلوب',
//            'whatsapp.url' => 'حقل الواتساب يجب ان يكون رابطا مبدؤا ب ://https',
            'instagram.required' => 'حقل الانستغرام مطلوب',
//            'instagram.url' => 'حقل الانستغرام يجب ان يكون رابطا مبدؤا ب ://https',
            'telegram.required' => 'حقل التليجرام مطلوب',
//            'telegram.url' => 'حقل التليجرام يجب ان يكون رابطا مبدؤا ب ://https',
            'logo.required' => 'حقل االلوجو مطلوب',
            'logo.image' => 'حقل اللوجو يجب ان يكون صورة',

        ];
    }
}
