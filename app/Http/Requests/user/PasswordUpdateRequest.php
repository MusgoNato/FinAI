<?php

namespace App\Http\Requests\user;

use Illuminate\Foundation\Http\FormRequest;

class PasswordUpdateRequest extends FormRequest
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
        // Se caso o usuario tem uma senha então a validação deve ocorrer para a atualização da senha do mesmo, caso contrario
        // somente a criação de uma nova senha pois fez login com um serviço externo.
        if(auth()->user()->password)
        {
            return [
                'current_password' => 'required',
                'password' => 'required|confirmed|min:8',
            ];
        }
        return [
            'password' => 'required|confirmed|min:8',
        ];
    }
}
