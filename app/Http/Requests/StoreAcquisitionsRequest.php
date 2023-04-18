<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAcquisitionsRequest extends FormRequest
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
            'customer_id' => 'required',
            'product_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'customer_id.required' => 'O campo ID do cliente é obrigatório',
            'product_id.required' => 'O campo ID do produto é obrigatório',
        ];
    }
}
