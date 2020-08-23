<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleFieldsValidation extends FormRequest
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
            'customer.name' => 'required',
            'customer.cpf' => 'required|unique:App\Customer,cpf',
            'customer.email' => 'required|unique:App\Customer,email',

            'product.id' => 'required',

            'date' => 'required|date',
            'quantity' => 'required|numeric|min:1|max:10',
            'discount' => 'numeric|max:100',
            'status' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'product.id.required' => 'O campo produto é obrigatório.',
        ];
    }
}
