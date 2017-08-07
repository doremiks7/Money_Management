<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Auth;

class WalletRequest extends Request
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
            'txtNameWallet' => 'string|required|unique:wallets,name,'.$this->id,
            'txtAmountWallet' => 'integer|required'
        ];
    }
    public function messages()
    {
        return [
            'txtNameWallet.unique' => 'this name is exist',
            'txtNameWallet.required' => 'please enter wallet name',
            'txtNameWallet.string' => 'this name must be a text',
            'txtAmountWallet.integer' => 'amount must be positive integers',
            'txtAmountWallet.required' => 'please enter amount name'
        ];
    }
}
