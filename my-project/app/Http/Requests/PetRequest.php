<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PetRequest extends FormRequest
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
            'descricao' => 'required',
            'especie_id' => 'required',
            'cidade_id' => 'required',
            'estado_id' => 'required',
            'idadeEstimada' => 'required',
            'nome' => 'required',
            'porte_id' => 'required',
            'raca_id' => 'required',
            'user_id' => 'required',
            'vacinas' => 'required',
        ];
    }

    public function messages(): array
    {
        return[
            'descricao.required' => "Campo Descrição é obrigatório!",
            'especie_id.required' => "Campo Espécie é obrigatório!",
            'cidade_id.required' => "Campo Cidade é obrigatório!",
            'estado_id.required' => "Campo Estado é obrigatório!",
            'idadeEstimada.required' => "Campo Idade Estimada é obrigatório!",
            'nome.required' => 'Campo Nome é obrigatório!',
            'porte_id.required' => "Campo Porte é obrigatório!",
            'raca_id.required' => "Campo Raça é obrigatório!",
            'user_id.required' => "Campo Nome do Doador é obrigatório!",
            'vacinas.required' => "Campo Vacinas é obrigatório!",
        ];
    }
}
