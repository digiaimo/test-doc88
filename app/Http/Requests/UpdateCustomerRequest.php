<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
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
            'email' => 'unique:customers,email,NULL,id,deleted_at,NULL|email',
            'phone' => 'numeric',
            'date_of_birth' => 'date',
        ];
    }

    public function mensagens()
    {
        return [
            'email.unique' => 'O email informado já está cadastrado',
            'email.email' => 'O email informado não é válido',
            'phone.numeric' => 'O campo telefone deve conter apenas números',
            'date_of_birth.date' => 'O campo data de nascimento deve ser uma data válida',
        ];
    }
}
