<?php

namespace App\Http\Requests\Contacts;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Traits\SanitizesInput;

class StoreRequest extends FormRequest
{
    use SanitizesInput;

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
     * Filters to be applied to the input.
     *
     * @return array
     */
    public function filters()
    {
        return [
            'after' => [
                'nome'      => 'cast:string|trim_null',
                'tags'      => 'cast:string|trim_null',
                'telefones' => 'cast:array',
                'enderecos' => 'cast:array',
            ],
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nome'                 => 'required|string',
            'tags'                 => 'required|string',
            'telefones'            => 'required|array|min:1',
            'enderecos'            => 'required|array|min:1',
            'enderecos.*.cep'      => 'required|max:9',
            'enderecos.*.endereco' => 'required|string',
            'enderecos.*.bairro'   => 'required|string',
            'enderecos.*.cidade'   => 'required|string',
            'enderecos.*.numero'   => 'required|numeric',
            'enderecos.*.uf'       => 'required|string|max:2',

        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nome.required'                 => 'O campo "Nome" é obrigatório ser informado',
            'nome.string'                   => 'O campo "Nome" deve ser do tipo string',
            'tags.required'                 => 'O campo "Tags" é obrigatório ser informado',
            'tags.string'                   => 'O campo "Tags" deve ser do tipo string',
            'telefones.required'            => 'O campo "Telefone" é obrigatório ser informado',
            'telefones.string'              => 'O campo "Telefone" deve ser do tipo string',
            'telefones.array'               => 'O campo "Telefone" deve conter pelo menos um valor',
            'telefones.min'                 => 'Informe ao menos um telefone',
            'enderecos.required'            => 'Preencha os campos de "Endereço"',
            'enderecos.array'               => 'O campo "Endereço" deve conter pelo menos um valor',
            'enderecos.min'                 => 'Informe ao menos um endereço',
            'enderecos.*.cep.required'      => 'O campo "CEP" é obrigatório ser informado',
            'enderecos.*.cep.numeric'       => 'O campo "CEP" deve ser do tipo numérico',
            'enderecos.*.cep.max'           => 'O campo "CEP" deve ter no máximo 9 caracteres',
            'enderecos.*.endereco.required' => 'O campo "Logradouro" é obrigatório ser informado',
            'enderecos.*.endereco.string'   => 'O campo "Logradouro" deve ser do tipo string',
            'enderecos.*.bairro.required'   => 'O campo "Bairro" é obrigatório ser informado',
            'enderecos.*.bairro.string'     => 'O campo "Bairro" deve ser do tipo string',
            'enderecos.*.cidade.required'   => 'O campo "Cidade" é obrigatório ser informado',
            'enderecos.*.cidade.string'     => 'O campo "Cidade" deve ser do tipo string',
            'enderecos.*.numero.required'   => 'O campo "Número" é obrigatório ser informado',
            'enderecos.*.numero.numeric'    => 'O campo "Número" deve ser do tipo numérico',
            'enderecos.*.uf.required'       => 'O campo "UF" é obrigatório ser informado',
            'enderecos.*.uf.string'         => 'O campo "UF" deve ser do tipo string',
            'enderecos.*.uf.max'            => 'O campo "UF" deve ter no máximo 2 caracteres',
        ];
    }
}
