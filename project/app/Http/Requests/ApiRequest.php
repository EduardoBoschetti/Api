<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ApiRuleFullNome;
use Illuminate\Validation\Rules\Password;

class ApiRequest extends FormRequest
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
            'name' => ['required', 'string',new ApiRuleFullNome],
            'email' =>['required', 'email', 'unique:App\Models\ApiCrud,email'],
            'password'=>['required', Password::min(8),Password::min(8)->letters(2),Password::min(8)->numbers(2),Password::min(8)->symbols(1)]
        ];
    }
}
