<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 08.07.2020
 */

namespace App\Common\Validation\Validators;

use App\Common\Validation\Constraints\PhoneNumber;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class PhoneNumberValidator
 *
 * @package App\Common\Validation\Validators
 */
class PhoneNumberValidator extends ConstraintValidator
{

    /**
     * @param mixed $value
     * @param Constraint $constraint
     *
     * @return void
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof PhoneNumber) {
            throw new UnexpectedTypeException($constraint, PhoneNumber::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if (!preg_match('/^((\+)?\d{2})?\d{9}$/', $value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }

    }

}
