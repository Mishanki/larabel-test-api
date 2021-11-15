<?php

namespace App\Helpers\Validator;

use Illuminate\Support\Facades\Validator as V;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator as Validator;

abstract class AbstractValidator implements ValidationInterface
{
    /* @var $errors */
    public $errors = [];

    /* @var Validator $validator */
    public $validator;

    /* @var $reqData array */
    public $reqData;

    /**
     * AbstractValidator constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->reqData = $data;
        $this->setAttributes($data);
    }

    /**
     * @return bool
     */
    public function validate(): bool
    {
        try {
            $this->validator = V::make($this->reqData, $this->rules(), $this->messages());
            $this->getValidator()->validate();
        } catch (ValidationException $e) {
            $this->errors[] = $e->errors();

            return false;
        }

        return true;
    }

    /**
     * @return bool
     */
    public function fails(): bool
    {
        return $this->getValidator()->fails();
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * @return Validator
     */
    public function getValidator(): Validator
    {
        return $this->validator;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [];
    }
}
