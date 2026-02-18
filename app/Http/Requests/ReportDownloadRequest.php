<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportDownloadRequest extends FormRequest
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
            //
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'category' => 'nullable|in:Alimentacao,Renda,Transporte,Lazer,Outros',
            'document_type' => 'required|in:pdf,excel,csv',
            'type' => 'nullable|in:Receita,Despesa',
            'min_amount' => 'nullable|numeric',
            'max_amount' => 'nullable|numeric|gte:min_amount',
            'sort_by' => 'nullable|in:date_desc,date_asc,amount_desc,amount_asc',
            'group_by' => 'nullable|string|in:month,category,account',
        ];
    }
}
