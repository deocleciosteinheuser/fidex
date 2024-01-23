<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUnidadeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [            
            "data.*.unidade_nome" => ['required'],
            "data.*.unidade_id" => ['required', 'integer'],
            "data.*.mrr" => ['numeric'],
            "data.*.usuario_pessoa_nome" => ['required', 'max:255'],
            "data.*.unidade_porte" => ['max:10'],
            "data.*.unidade_geo_nome" => ['max:20'],
            "data.*.modelo_atendimento_nome" => ['required','max:200'],
            "data.*.modelo_atendimento_nome" => ['required','max:200'],
        ];
    }
}
