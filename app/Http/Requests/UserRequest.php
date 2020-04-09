<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->method() == 'DELETE' && ($this->route('user') == config('cms.DEFAULT_USER_ID') || auth()->id() == $this->route('user')) )
            return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|min:3',
            'email'=> 'required|email|unique:users',
            'password'=> 'required|min:3|confirmed'
        ];
        switch($this->method()){
            case 'PUT' :
            case 'PATCH' :
                $rules ['email'] = 'required|email|'.Rule::unique('users', 'email')->ignore($this->route('user'));
                $rules ['password'] = 'required_with:password_confirmation|confirmed';
            break;
            case 'DELETE':
                $rules = [];
            break;
        }
        return $rules;
    }
}
