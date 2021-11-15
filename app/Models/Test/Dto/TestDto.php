<?php

namespace App\Models\Test\Dto;

use App\Helpers\Validator\AbstractValidator;

class TestDto extends AbstractValidator
{
    /* @var $title string */
    public $title;
    /* @var $body string */
    public $body;
    /* @var $migration_name string */
    public $migration_name;

    /**
     * @param array $data
     */
    public function setAttributes(array $data)
    {
        foreach ($data as $name => $value) {
            if (property_exists(__CLASS__, $name)) {
                $this->{$name} = $value;
            }
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'migration_name' => ['required', 'max:255']
        ];
    }

   /**
    * Get the error messages for the defined validation rules.
    *
    * @return array
    */
    public function messages(): array
    {
        return [
            'title.required' => 'A title is required',
            'body.required' => 'A message is required',
        ];
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function getMigrationName(): string
    {
        return $this->migration_name;
    }
}
