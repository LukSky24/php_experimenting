<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 01.06.2020
 */

namespace App\Common\Doctrine\Validation\Validators;

use App\Common\Doctrine\Validation\Constraints\EntityExists;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class EntityExistsValidator
 *
 * @package App\Common\Doctrine\Validation\Validators
 */
class EntityExistsValidator extends ConstraintValidator
{
    /**
     * @var ManagerRegistry
     */
    protected ManagerRegistry $managerRegistry;

    /**
     * EntityExistsValidator constructor.
     *
     * @param ManagerRegistry $managerRegistry
     */
    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
    }

    /**
     * @param mixed $value
     * @param Constraint $constraint
     *
     * @return void
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof EntityExists) {
            throw new UnexpectedTypeException($constraint, EntityExists::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        $entity = $this->managerRegistry->getManager($constraint->managerName)
            ->getRepository($constraint->class)
            ->findOneBy([$constraint->field => $value]);

        if (empty($entity)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}
