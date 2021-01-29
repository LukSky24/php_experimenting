<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 18.05.2020
 */

namespace App\Common\Validation\Validators\Address;

use App\Common\Validation\Constraints\Address\PostCode;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class PostCodeValidator
 *
 * @package App\Common\Validation\Validators
 */
class PostCodeValidator extends ConstraintValidator
{
    /**
     * @param mixed $value
     * @param Constraint $constraint
     *
     * @return void
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof PostCode) {
            throw new UnexpectedTypeException($constraint, PostCode::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        if (!preg_match('/^\d{2}-\d{3}$/', $value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
