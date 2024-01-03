<?php

namespace App\Validators;

class BookValidator extends BaseValidator
{
    public function rules()
    {
        return [
            'titulo' => [
                'required',
                'string',
                'min:3',
                'max:40'
            ],
            'editora' => [
                'string',
                'min:3',
                'max:40'
            ],
            'edicao' => ['integer'],
            'anopublicacao' => [
                'string',
                'size:4'
            ],
            'valor' => ['numeric'],
            'autores' => ['array'],
            'assuntos' => ['array'],
        ];
    }
}
