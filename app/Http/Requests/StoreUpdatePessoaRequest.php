<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use JsonException;
use PHPUnit\Util\InvalidJsonException;
use RuntimeException;

class StoreUpdatePessoaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @todo Adicionar validação de token
     */
    public function authorize(): bool
    {
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new JsonException(json_last_error_msg(), json_last_error());
        }
        return true;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $oRequire = Rule::requiredIf(function(){
            return in_array($this->method(), [Request::METHOD_PUT, Request::METHOD_POST]);
        });
        $rules = [
            'nome' => [$oRequire, 'min:3', 'max:200'],
            'sobrenome' => [$oRequire, 'min:3', 'max:200'],
            'email' => [
                $oRequire,
                'email',
                'max:255',
                in_array($this->method(), [Request::METHOD_PATCH, Request::METHOD_PUT])
                   ? Rule::unique('pessoa')->ignore($this->id)
                   : Rule::unique('pessoa'),
            ]
        ];

        array_walk($rules, function($dados) {
            return array_filter($dados);
        });
        return $rules;
    }
}
