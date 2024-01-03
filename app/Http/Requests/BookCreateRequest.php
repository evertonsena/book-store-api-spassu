<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        dd('b');
        return [
            'titulo' => ['required', 'string', 'min:3', 'max:40'],
            'editora' => ['string', 'min:3', 'max:40'],
            'edicao' => ['integer'],
            'anopublicacao' => ['string', 'size:4'],
            'valor' => ['numeric'],
            'autores' => ['array'],
            'assuntos' => ['array'],
        ];
    }
}
