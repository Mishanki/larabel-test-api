<?php

namespace App\Core;

use App\Exceptions\Http\BadRequestHTTPException;
use App\Helpers\Validator\ValidationInterface;

trait ModelValidationHandler
{
    /**
     * @param ValidationInterface $dto
     * @return bool
     */
    public function handleError(ValidationInterface $dto): bool
    {
        if (!$dto->fails()) {
            return true;
        }

        return $this->getFirstErrorMessage($dto);
    }

    /**
     * @param ValidationInterface $dto
     * @return bool
     */
    public function getFirstErrorMessage(ValidationInterface $dto): bool
    {
        foreach ($dto->getErrors() as $messages) {
            foreach ($messages as $name => $message) {
                throw new BadRequestHTTPException(end($message) . ' Field name: <'.$name.'>.', Errors::VALIDATION_ERROR);
            }
        }

        return true;
    }
}
