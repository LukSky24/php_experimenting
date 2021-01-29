<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 14.07.2020
 */

namespace App\Common\Validation\Validators;

use App\Common\Validation\Constraints\Sku;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class SkuValidator
 *
 * @package App\Core\Products\Validation\Validators
 */
class SkuValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     *
     * @return void
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof Sku) {
            throw new UnexpectedTypeException($constraint, Sku::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if (!preg_match('/^[A-Za-z\-\d]{2,20}$/', $value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }

}
