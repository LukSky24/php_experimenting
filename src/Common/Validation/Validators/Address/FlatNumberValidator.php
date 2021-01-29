<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 11.09.2020
 */

namespace App\Common\Validation\Validators\Address;

use App\Common\Validation\Constraints\Address\FlatNumber;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class FlatNumberValidator
 *
 * @package App\Common\Validation\Validators\Address
 */
class FlatNumberValidator extends BuildingNumberValidator
{
    /**
     * @param Constraint $constraint
     */
    protected function supports(Constraint $constraint): void
    {
        if (!$constraint instanceof FlatNumber) {
            throw new UnexpectedTypeException($constraint, FlatNumber::class);
        }
    }

}
