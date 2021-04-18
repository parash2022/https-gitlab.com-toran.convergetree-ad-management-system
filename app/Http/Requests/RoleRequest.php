<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
                'title'           => ['required', 'string', "unique:roles,title,$this->id,id",'min:2','max:255'],
            ];
        }else{
            return [
               
                'title'           => ['required', 'string', "unique:roles,title",'min:2','max:255'],
                
            ];
            
        }
    }
}
