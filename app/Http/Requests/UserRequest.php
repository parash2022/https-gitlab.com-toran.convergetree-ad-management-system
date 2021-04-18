<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if($this->id){
            return [
                'name'      => ['required', 'string','min:2','max:255'],
                'email'           => ['required', 'email', "unique:users,email,$this->id,id",'min:5','max:255'],
                'password'        => ['nullable', 'string','min:4','max:255'],
                'role'            => ['required', 'integer', 'exists:roles,id']
            ];
        }else{
            return [
                'name'      => ['required', 'string','min:2','max:255'],
                'email'           => ['required', 'email', "unique:users,email",'min:5','max:255'],
                'password'        => ['required', 'string','min:4','max:255'],
                'role'            => ['required', 'integer', 'exists:roles,id']
            ];
            
        }
    }
}
