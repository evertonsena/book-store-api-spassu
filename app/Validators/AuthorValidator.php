<?php

namespace App\Validators;

class AuthorValidator extends BaseValidator
{
    public function rules()
    {
        return [
            'nome' => ['required', 'string', 'min:3', 'max:40'],
        ];
    }
}
