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
     *  Filters to be applied to the input.
     *
     *  @return array
     */
    public function filters()
    {
        return [
            'after' => [
                'nome'                  => 'cast:string',
                'tags'                  => 'cast:string',
                'telefone'              => 'cast:string',
                'cep'                   => 'cast:string',
                'endereco'              => 'cast:string',
                'bairro'                => 'cast:string',
                'cidade'                => 'cast:string',
                'uf'                    => 'cast:string',
                'numero'                => 'cast:string',
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
            'nome'         => 'required|string|unique:contatos,nome',
            'tags'         => 'required|string',
            'telefone'     => 'required|string',
            'cep'          => 'required|string|max:9',
            'endereco'     => 'required|string',
            'bairro'       => 'required|string',
            'cidade'       => 'required|string',
            'uf'           => 'required|string|max:2',
            'numero'       => 'required|string',
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
            'nome.required'                 => __('contacts/store.nome_required'),
            'nome.string'                   => __('contacts/store.nome_string'),
            'nome.unique'                   => __('contacts/store.nome_unique'),
            'tags.required'                 => __('contacts/store.tags_required'),
            'tags.string'                   => __('contacts/store.tags_string'),
            'telefones.required'            => __('contacts/store.telefones_required'),
            'telefones.string'              => __('contacts/store.telefones_string'),
            'cep.required'                  => __('contacts/store.cep_required'),
            'cep.string'                    => __('contacts/store.cep_string'),
            'cep.max'                       => __('contacts/store.cep_max'),
            'endereco.required'             => __('contacts/store.endereco_required'),
            'endereco.string'               => __('contacts/store.endereco_string'),
            'bairro.required'               => __('contacts/store.bairro_required'),
            'bairro.string'                 => __('contacts/store.bairro_string'),
            'cidade.required'               => __('contacts/store.cidade_required'),
            'cidade.string'                 => __('contacts/store.cidade_string'),
            'uf.required'                   => __('contacts/store.uf_required'),
            'uf.string'                     => __('contacts/store.uf_string'),
            'uf.max'                        => __('contacts/store.uf_max'),
            'numero.string'                 => __('contacts/store.numero_string'),
            'numero.required'               => __('contacts/store.numero_required'),
        ];
    }
}
