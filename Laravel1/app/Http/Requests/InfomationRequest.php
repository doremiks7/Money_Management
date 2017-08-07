<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class InfomationRequest extends Request
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
            'name' => 'required|max:255',
            'phone' => 'integer|min:10',
            'avatar' => 'file|image'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Need to A Name',
            'password.confirmed' => 'Password cofirm is not match',
            'phone.min' => 'Phone must be longer 10 character',
            'avatar.image' => 'It is not right picture'
        ];
    }
}
