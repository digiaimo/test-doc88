<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|unique:customers,email,NULL,id,deleted_at,NULL|email',
            'phone' => 'required|numeric',
            'date_of_birth' => 'required|date',
            'address' => 'required',
            'district' => 'required',
            'cep' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo email é obrigatório',
            'email.unique' => 'O email informado já está cadastrado',
            'email.email' => 'O email informado não é válido',
            'email.confirmed' => 'O email informado não é igual ao campo de confirmação',
            'phone.required' => 'O campo telefone é obrigatório',
            'phone.numeric' => 'O campo telefone deve conter apenas números',
            'date_of_birth.required' => 'O campo data de nascimento é obrigatório',
            'date_of_birth.date' => 'O campo data de nascimento deve ser uma data válida',
            'address.required' => 'O campo endereço é obrigatório',
            'district.required' => 'O campo bairro é obrigatório',
            'cep.required' => 'O campo cep é obrigatório',
        ];
    }
}
