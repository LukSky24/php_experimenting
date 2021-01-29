<?php
/**
 * Author: Paweł Paliński<pawel.palinski@nettle.pl>
 * Date: 22.12.2020
 */

namespace App\Common\Validation\Validators;

use App\Common\Validation\Constraints\Bloz;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class BlozValidator
 *
 * @package App\Common\Validation\Validators
 */
class BlozValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     *
     * @return void
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof Bloz) {
            throw new UnexpectedTypeException($constraint, Bloz::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if (strlen($value) !== 7 || !ctype_digit($value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
