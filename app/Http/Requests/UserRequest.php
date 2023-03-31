<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        if ($this->method() == 'post') {
            return [
                'name'      => ['required', 'string'],
                'email'     => ['required', 'email', 'unique:users'],
                'cpf'       => ['required', 'int', 'unique:users', 'cpf'],
                'addresses' => ['required', 'array'],
                'profile'   => ['required', 'string'],
            ];
        }

        return [];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'O nome é obrigatório',
            'email.required'   => 'O campo email é obrigatório',
            'email.email'      => 'O email inserido não é válido',
            'email.unique'     => 'O campo email deve ser único',
            'cpf.required'     => 'O campo cpf é obrigatório',
            'cpf.unique'       => 'O campo cpf deve ser único',
            'address.required' => 'O campo endereço é obrigatório',
            'cep.required'     => 'O campo cep é obrigatório'
        ];
    }

    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();

        $response = response()->json([
            "error" => "Erro no envio de dados.",
            "message" => $errors->first()
        ], 400);
        throw new HttpResponseException($response);
    }
}
