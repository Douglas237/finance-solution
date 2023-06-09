<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'last_name' => 'required|string',
            'date_naissance' => 'required|date',
            'sexe' => 'required|string',
            'cni' => 'required|string',
            'telephone' => array('required', 'regex:/(^6[25-9][0-9]([ ]([0-9]){3}){2}$)/u'),
            'password' => 'required|',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'username' => 'required|unique:users,username',

        ];
    }
}
