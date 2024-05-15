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
            'nome'=> ['required'],
            'descricao'=> ['required'],
            'idadeEstimada'=> ['required', 'numeric'],
            'porte'=> ['required'],
            'especie'=> ['required'],
            'raca'=> ['required'],
            'cidade'=> ['required'],
            'estado'=> ['required'],
            'vacinas'=> ['required'],
            'genero'=> ['required'],
            'castracao'=> ['required'],
        ];
    }

    public function messages(): array
    {
        return[
            'descricao'=> 'Campo descrição obrigatório',
        ];
    }
}
