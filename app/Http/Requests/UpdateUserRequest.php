<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $user = request()->route('user');
        return [
            'name' => 'required|string'.$user->id,
            'email' => 'required|email:rfc,dns|unique:users,email,'.$user->id,
            'last_name' => 'required|string'.$user->id,
            'date_naissance' => 'required|date'.$user->id,
            'sexe' => 'required|string'.$user->id,
            'cni' => 'required|string'.$user->id,
            'telephone' => array('required', 'regex:/(^6[25-9][0-9]([ ]([0-9]){3}){2}$)/u').$user->id,
            'password' => 'required|',
            'username' => 'required|unique:users,username,'.$user->id,
        ];
    }
}
