<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 14.07.2020
 */

namespace App\Common\Validation\Validators;

use App\Common\Validation\Constraints\VatRate as VatRateConstraint;
use App\Common\ValueObjects\VatRate;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class VatRateValidator
 *
 * @package App\Common\Validation\Validators
 */
class VatRateValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     *
     * @return void
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof VatRateConstraint) {
            throw new UnexpectedTypeException($constraint, VatRateConstraint::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if (!VatRate::contains($value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }

}
