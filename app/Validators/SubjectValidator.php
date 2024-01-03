<?php

namespace App\Validators;

class SubjectValidator extends BaseValidator
{
    public function rules()
    {
        return [
            'descricao' => ['required', 'string', 'min:3', 'max:20'],
        ];
    }
}
