<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 11.09.2020
 */

namespace App\Common\Validation\Validators\Address;

use App\Common\Validation\Constraints\Address\BuildingNumber;
use App\Common\Validation\Constraints\Address\FlatNumber;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class BuildingNumberValidator
 *
 * @package App\Common\Validation\Validators\Address
 */
class BuildingNumberValidator extends ConstraintValidator
{

    /**
     * @param mixed $value
     * @param Constraint $constraint
     *
     * @return void
     */
    public function validate($value, Constraint $constraint): void
    {
        /** @var BuildingNumber|FlatNumber $constraint */

        $this->supports($constraint);

        if ($value === null || $value === '') {
            return;
        }

        $length = strlen($value);

        if ($length < 1 || $length > 50) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }

    /**
     * @param Constraint $constraint
     */
    protected function supports(Constraint $constraint): void
    {
        if (!$constraint instanceof BuildingNumber) {
            throw new UnexpectedTypeException($constraint, BuildingNumber::class);
        }
    }

}
