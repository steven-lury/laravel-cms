<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryDeleteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $id = $this->route('category');
        $def = config('cms.DEFAULT_CAT_ID');
        return ($id == $def ? false: true);

    }

    // public function forbiddenResponse(){
    //     return back()->with('errorMsg', 'You Can Not Delete Uncategorized Category');
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
