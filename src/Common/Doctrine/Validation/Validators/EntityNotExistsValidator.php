<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 09.07.2020
 */

namespace App\Common\Doctrine\Validation\Validators;

use App\Common\Doctrine\Validation\Constraints\EntityNotExists;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/**
 * Class EntityNotExistsValidator
 *
 * @package App\Common\Validation\Validators
 */
class EntityNotExistsValidator extends ConstraintValidator
{
    /**
     * @var ManagerRegistry
     */
    protected ManagerRegistry $managerRegistry;

    /**
     * @var PropertyAccessorInterface
     */
    protected PropertyAccessorInterface $propertyAccessor;

    /**
     * EntityExistsValidator constructor.
     *
     * @param ManagerRegistry $managerRegistry
     * @param PropertyAccessorInterface $propertyAccessor
     */
    public function __construct(ManagerRegistry $managerRegistry, PropertyAccessorInterface $propertyAccessor)
    {
        $this->managerRegistry = $managerRegistry;
        $this->propertyAccessor = $propertyAccessor;
    }

    /**
     * @param mixed $value
     * @param Constraint $constraint
     *
     * @return void
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof EntityNotExists) {
            throw new UnexpectedTypeException($constraint, EntityNotExists::class);
        }

        if ($value === null || $value === '') {
            return;
        }

        /** @var EntityManagerInterface $em */
        $em = $this->managerRegistry->getManager($constraint->managerName);

        $qb = $em->createQueryBuilder()
            ->select('COUNT(entity.id)')
            ->from($constraint->entity, 'entity')
            ->andWhere('entity.' . $constraint->field . ' = :field')
            ->setParameter('field', $value);

        if (!empty($constraint->exceptId)) {
            $qb->andWhere('entity.id != :exceptId')
                ->setParameter('exceptId', $constraint->exceptId);
        }

        if (!empty($constraint->exceptIdPropertyPath)) {
            $validatedObject = $this->context->getObject();
            $exceptId = $this->propertyAccessor->getValue($validatedObject, $constraint->exceptIdPropertyPath);
            if (!empty($exceptId)) {
                $qb->andWhere('entity.id != :exceptIdProperty')
                    ->setParameter('exceptIdProperty', $exceptId);
            }
        }

        $count = $qb->getQuery()
            ->getSingleScalarResult();

        if ($count) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }

}
