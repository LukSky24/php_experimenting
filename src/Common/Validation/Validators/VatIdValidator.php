<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 18.05.2020
 */

namespace App\Common\Validation\Validators;

use App\Common\Validation\Constraints\VatId;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class VatIdValidator
 *
 * @package App\Common\Validation\Validators
 */
class VatIdValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     *
     * @return void
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof VatId) {
            throw new UnexpectedTypeException($constraint, VatId::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if (strlen($value) !== 10 || !ctype_digit($value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
