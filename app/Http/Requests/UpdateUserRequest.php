<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => [
                'required',
                'regex:/^[a-zA-ZÀ-ÿ\s]+$/',  // regex para validar apenas letras do alfabeto (maiúsculas e minúsculas, com acento ou não) e espaços em branco.
                'min:3',
                'max:50'
            ],
            'apelido' => [
                'nullable',
                'string',
                'min:3',
                'max:30'
            ],
            'telefone' => [
                'required',
                'regex:/^\(\d{2}\)\s\d{5}\-\d{4}$/', // considerando telefone no formato "(99) 99999-9999"
            ],
            'rua' => [
                'required',
                'regex:/^[a-zA-ZÀ-ÿ\s]+$/',  // mesmo do "name"
                'max:50'
            ],
            'cep' => [
                'required',
                'regex:/^\d{5}\-\d{3}$/' // considerando cep no formato "99999-999"
            ],
            'numero' => [
                'required',
                'integer',
                'digits_between:1,4'
            ],
            'complemento' => [
                'nullable',
                'string',
                'max:50'
            ],
            'cidade' => [
                'required',
                'regex:/^[a-zA-ZÀ-ÿ\s]+$/',  // mesmo do "name"
                'max:50'
            ],
            'estado' => [
                'required',
                'regex:/^[a-zA-ZÀ-ÿ\s]+$/',  // mesmo do "name"
                'max:50'
            ],
            'país' => [
                'required',
                'regex:/^[a-zA-ZÀ-ÿ\s]+$/',  // mesmo do "name"
                'max:50'
            ],
            'bairro_id' => [
                'required',
                'integer',
                'max:5'
            ]
        ];

        if ($this->segment(2) === 'produtores') {
            $rules['bairro_id'] = ['nullable', 'integer', 'max:5'];
            $rules['bairro'] = ['required', 'regex:/^[a-zA-ZÀ-ÿ\s0-9]+$/', 'min:3', 'max:40'];
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório.',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres.',
            'min' => 'O campo :attribute deve ter no mínimo :min caracteres.',
            'digits_between' => 'O campo :attribute deve ter entre :min e :max dígitos.',
            'string' => 'O campo :attribute deve ser uma string.',
            'integer' => 'O campo :attribute deve ser numérico.',
            'unique' => 'O campo :attribute está sendo utilizado.',
            'email' => 'O email precisa ser válido.',
            'telefone.regex' => 'O campo telefone deve estar no formato (99) 99999-9999.',
            'cpf.regex' => 'O campo CPF deve estar no formato 999.999.999-99.',
            'cnpj.regex' => 'O campo CNPJ deve estar no formato 99.999.999/9999-99.',
            'cep.regex' => 'O campo CEP deve estar no formato 99999-999.',
        ];
    }
}
