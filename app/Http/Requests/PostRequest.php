<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
                'title'             => ['required','string','min:2','max:65000'],
                'content'           => ['nullable','string'],
                'parent'            => ['nullable','integer'],
                'featured_image'    => ['nullable','base64_image'],
                'status'            => ['required','in:Published,Draft'] 
            ];
    }
}
