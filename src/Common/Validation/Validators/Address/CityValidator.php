<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 29.05.2020
 */

namespace App\Common\Validation\Validators\Address;

use App\Common\Validation\Constraints\Address\City;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class CityValidator
 * 
 * @package App\Common\Validation\Validators
 */
class CityValidator extends ConstraintValidator
{

    /**
     * @param mixed $value
     * @param Constraint $constraint
     *
     * @return void
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof City) {
            throw new UnexpectedTypeException($constraint, City::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if (strlen($value) < 2) {
            $this->context->buildViolation($constraint->minMessage)
                ->addViolation();
        }elseif (strlen($value) > 50){
            $this->context->buildViolation($constraint->maxMessage)
                ->addViolation();
        }
    }

}
