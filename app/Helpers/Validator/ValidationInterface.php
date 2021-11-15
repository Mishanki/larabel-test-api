<?php

namespace App\Helpers\Validator;

interface ValidationInterface
{
    public function rules(): array;

    public function messages(): array;

    public function validate(): bool;

    public function fails(): bool;

    public function getErrors(): array;

    public function getValidator();
}
