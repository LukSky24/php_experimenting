<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 29.05.2020
 */

namespace App\Common\Validation\Validators\Address;

use App\Common\Validation\Constraints\Address\Street;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class StreetValidator
 *
 * @package App\Common\Validation\Validators
 */
class StreetValidator extends ConstraintValidator
{

    /**
     * @param mixed $value
     * @param Constraint $constraint
     *
     * @return void
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof Street) {
            throw new UnexpectedTypeException($constraint, Street::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if (strlen($value) < 3) {
            $this->context->buildViolation($constraint->minMessage)
                ->addViolation();
        }elseif (strlen($value) > 255){
            $this->context->buildViolation($constraint->maxMessage)
                ->addViolation();
        }
    }

}
