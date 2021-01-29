<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 12.11.2020
 */

namespace App\Common\Validation\Validators;

use App\Common\Validation\Constraints\Ean;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class EanValidator
 *
 * @package App\Common\Validation\Validators
 */
class EanValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     *
     * @return void
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof Ean) {
            throw new UnexpectedTypeException($constraint, Ean::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if (strlen($value) !== 13 || !ctype_digit($value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }

}
