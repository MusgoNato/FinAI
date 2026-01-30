<?php

namespace App\Http\Requests\transactions;

use Illuminate\Foundation\Http\FormRequest;

class TransactionRequest extends FormRequest
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
        return [
            'description' => 'required|string|max:80',
            'category' => 'required|in:Alimentacao,Renda,Transporte,Lazer,Outros',
            'type' => 'required|in:Receita,Despesa',
            'price' => 'required|numeric|min:0|max:9999999',
            'date' => 'required|date',
            'notes' => 'nullable|string|max:255',
        ];
    }
}
