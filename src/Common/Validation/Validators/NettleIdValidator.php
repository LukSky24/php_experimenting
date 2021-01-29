<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 29.05.2020
 */

namespace App\Common\Validation\Validators;

use App\Common\Validation\Constraints\NettleId;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class NettleIdValidator
 *
 * @package App\Common\Validation\Validators
 */
class NettleIdValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     *
     * @return void
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof NettleId) {
            throw new UnexpectedTypeException($constraint, NettleId::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if (!preg_match('/^NT\d{9}$/', $value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }

}
