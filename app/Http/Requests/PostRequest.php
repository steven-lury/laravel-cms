<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
        //dd($this->route('post'));
        $rules = [
            'title'        => 'required|min:5',
            'slug'         => 'required|min:5|unique:posts',
            'body'         => 'required|min:5',
            'category_id'  => 'required',
            'published_at' => 'nullable|date_format:Y-m-d H:i:s',
            'image'        => 'mimes:png, jpeg, jpg, JPEG',
        ];
        switch($this->method()){
            case 'PUT':
            case 'PATCH':
                $rules ['slug'] = 'required|min:5|'.Rule::unique('posts', 'slug')->ignore($this->route('post'));
            break;
        }
        return $rules;
    }
}
