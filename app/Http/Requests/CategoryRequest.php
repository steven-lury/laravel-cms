<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $rules = [
            'title' => 'required|unique:categories|max:255',
            'slug'  => 'required|unique:categories|max:255'
        ];
        switch($this->method()){
            case 'PUT':
            case 'PATCH':
                $rules = [
                    'title' => 'required|max:255,'.Rule::unique('categories', 'title')->ignore($this->route('category')),
                    'slug' => 'required|max:255,'.Rule::unique('categories', 'slug')->ignore($this->route('category'))
                ];
            break;
        }
        return $rules;
    }
}
