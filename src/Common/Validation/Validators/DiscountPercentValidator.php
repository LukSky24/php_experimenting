<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 23.09.2020
 */

namespace App\Common\Validation\Validators;

use App\Common\Validation\Constraints\DiscountPercent;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class DiscountPercentValidator
 *
 * @package App\Common\Validation\Validators
 */
class DiscountPercentValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     *
     * @return void
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof DiscountPercent) {
            throw new UnexpectedTypeException($constraint, DiscountPercent::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if ($value < 0 || $value > 100) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
