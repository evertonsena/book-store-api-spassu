<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;

abstract class BaseValidator
{

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @var Illuminate\Support\Facades\Validator
     */
    protected $validator;

    /**
     * create a validator to be used here
     *
     * @param array $data
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->validator = Validator::make($data, $this->rules());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Check if data is valid
     *
     * @return bool
     */
    public function validate(): bool
    {
        $this->errors = [];

        if ($this->validator->fails()) {
            $this->errors = $this->validator->errors();
            return false;
        }
        return true;
    }

    /**
     * Returns a errors object
     *
     * @return mixed
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * Returns a validated fields object
     *
     * @return array
     */
    public function validated(): array
    {
        return (array) $this->validator->validated();
    }
}
