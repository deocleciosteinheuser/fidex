<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUpdateDadosNpsRequest extends FormRequest
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
        return [];
        //Se validar precisa aumetar o tempo do apache pra mais de 10 minutos
        return [            
            "pesquisa.dados.*.resposta_data" => ['required', 'date'],
            "pesquisa.dados.*.Resposta_nota" => ['required', Rule::in([0,1,2,3,4,5,6,7,8,9,10])],
            "pesquisa.dados.*.Resposta_descricao" => [],
            "pesquisa.dados.*.Grupo_nome" => ['max:200'],
            "pesquisa.dados.*.Sistema_nome" => ['required','max:200'],
            "pesquisa.dados.*.Categoria_nome" => ['required','max:200'],
            "pesquisa.dados.*.Feedback_visto" => [Rule::in([0, 1, 'Sim', 'Não', 'sim', 'não'])],
            "pesquisa.dados.*.Feedback_util" => [Rule::in([0, 1, 'Sim', 'Não', 'sim', 'não'])],
            "pesquisa.dados.*.Unidade_nome" => ['required','max:200'],
            "pesquisa.dados.*.Unidade_id" => ['integer'],
            "pesquisa.dados.*.Geo_nome" => ['max:200'],
            "pesquisa.dados.*.ModeloAtendimento_nome" => ['required','max:200'],
            "pesquisa.dados.*.Servidor_nome" => ['max:200']                       
        ];
    }
}
