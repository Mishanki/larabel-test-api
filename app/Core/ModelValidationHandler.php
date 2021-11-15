<?php

namespace App\Core;

use App\Exceptions\Http\BadRequestHTTPException;
use App\Helpers\Validator\ValidationInterface;
use Illuminate\Validation\ValidationException;

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

        return $this->getErrorsMessage($dto);
    }

    /**
     * @param ValidationInterface $dto
     * @return bool
     * @throws ValidationException
     */
    public function getErrorsMessage(ValidationInterface $dto): bool
    {
        if ($dto->getErrors()) {
            throw new ValidationException($dto->getValidator(), response()->json($dto->getErrors(), 422));
        }

        return true;
    }
}
