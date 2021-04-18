<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailSettingsRequest extends FormRequest
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
            'site__mail_from'       => ['required', 'email','min:5','max:255'],
            'site__mail_from_name'  => ['required', 'string','min:5','max:255'],
            'site__mail_driver'     => ['required', 'string','max:255'],
            'site__mail_port'       => ['nullable','max:255'],
            'site__mail_host'       => ['required_if:site__mail_driver,smtp','max:255'],
            'site__mail_username'   => ['required_if:site__mail_driver,smtp','max:255'],
            'site__mail_password'   => ['required_if:site__mail_driver,smtp','max:255'],
            'site__mail_ecryption'  => ['nullable', 'in:0,1'],
            

        ];
    }
}
