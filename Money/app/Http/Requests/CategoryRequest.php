<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CategoryRequest extends Request
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
            'txtNameCate' => 'required|unique:categories,name,'.$this->id,
            'sltKindCate' => 'in:1,2',
        ];
    }

    public function messages()
    {
        return [
            'sltKindCate.in' => 'Please Choose Kind of Category'
        ];
    }
}
