<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 06.05.2020
 */

namespace App\Common\Validation\Exceptions;

use App\Common\Translation\Exceptions\TranslatableException;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class ValidationException
 *
 * @package App\Common\Validation\Exceptions
 */
class ValidationException extends TranslatableException
{
    /**
     * @var string
     */
    protected string $messageKey = 'common.validation.validation_exception';

    /**
     * @var array
     */
    protected array $errors = [];

    /**
     * ValidationException constructor.
     *
     * @param ConstraintViolationListInterface $constraintViolationList
     */
    public function __construct(ConstraintViolationListInterface $constraintViolationList)
    {
        parent::__construct('Validation errors occured.');

        /** @var ConstraintViolation $item */
        foreach ($constraintViolationList as $item) {
            $this->errors[$item->getPropertyPath()] = $item->getMessageTemplate();
        }

        $this->httpStatus = 422;
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}
