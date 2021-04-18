<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GeneralSettingsRequest extends FormRequest
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
            'site__title'       => ['required', 'string','min:5','max:255'],
            'site__tagline'     => ['nullable', 'string','min:5','max:255'],
            'site__url'         => ['required', 'url', 'min:5','max:255'],
            'site__admin_email' => ['required','email', 'min:5','max:255'],
            'site__language'    => ['required','string', 'min:2','max:2'],
            'site__timezone'    => ['required','string', 'min:2','max:255'],
            'site__date_format' => ['required','string', 'min:2','max:255'], 
            'site__time_format' => ['required','string', 'min:2','max:255'], 

        ];
    }
}
