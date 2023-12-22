<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateUnidadeSistemaRequest extends FormRequest
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
    public function rules(string $sPrefix = 'unidades.*.'): array
    {
        return [

            "sistema.id" => ['integer'],
            "sistema.nome" => ['required', 'max:255'],
            "{$sPrefix}unidade_id" => ['integer'],
            "{$sPrefix}unidade_nome" => ['required'],
            "{$sPrefix}unidade_porte" => ['max:10'],
            "{$sPrefix}unidade_geo_nome" => ['max:20'],
            "{$sPrefix}mrr" => ['numeric'],
            "{$sPrefix}cs" => ['required', 'max:255'],
            "{$sPrefix}modelo_atendimento_id" => ['integer'],
            "{$sPrefix}modelo_atendimento_nome" => ['max:200'],
            "{$sPrefix}servidor_id" => ['integer'],
            "{$sPrefix}servidor_nome" => ['max:200'],
            "{$sPrefix}geo_nome" => ['max:200'],
        ];
    }
}
