<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'price' => 'numeric',
            'photo' => 'image',
        ];
    }

    public function messages()
    {
        return [
            'price.numeric' => 'O campo preço deve conter apenas números',
            'photo.image' => 'O campo foto deve ser uma imagem',
        ];
    }
}
