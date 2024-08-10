<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class sign_up_request extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email', 'regex:/^[^@]+@[^@]+\.[^@]+$/'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    
        if ($this->has('usertype')) {
            $rules['usertype'] = ['required', 'in:admin,user'];
        }
        if ($this->has('uservalid')) {
            $rules['uservalid'] = ['required', 'in:v,nv'];
        }
    
        return $rules;
    }
}
