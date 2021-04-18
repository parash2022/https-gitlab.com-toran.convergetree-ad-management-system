<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
                'platform'          => ['required','array'],
                'client'            => ['required','integer'],
                'adtype'            => ['required','integer'],
                'desktop_title'            => ['required','string','min:2','max:65000'],
                'desktop_url'              => ['required','url'],
                'desktop_featured_photo'   => ['nullable','base64_image'],
                'mobile_title'             => ['required_unless:skip_mobile,1','string','min:2','max:65000'],
                'mobile_url'               => ['required_unless:skip_mobile,1','url'],
                'mobile_featured_photo'    => ['nullable','base64_image'],
                'cat.*'             => ['required','integer'],
                'expiry'            => ['required','date'],
                'client_name'       => ['required_if:client,==,0']
            ];
    }

    public function messages(){
        return [
            'cat.0.required' => 'Please select category',
            'cat.1.required' => 'Please select sub-category'
        ];
    }
}
