<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NoticeRequest extends FormRequest
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
            //'recipient'      => ['required', 'string'],
            'title'          => ['required', 'string'],
            'message'        => ['required', 'string']
        ];
    }

    public function messages()
    {
        return [
            //'recipient.required'    => 'To is a required field',
            'title.required'        => 'Title is a required field',
            'message.required'      => 'Message is a required field'
        ];
    }
}
