<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 29.10.2020
 */

namespace App\Common\Utils;

use Closure;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;
use Symfony\Component\PropertyAccess\Exception\NoSuchPropertyException;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;
use Symfony\Component\PropertyAccess\PropertyPathInterface;

/**
 * Class ReflectionPropertyAccessor
 *
 * @package App\Common\Utils
 */
class ReflectionPropertyAccessor implements PropertyAccessorInterface
{
    /**
     * @var PropertyAccessorInterface
     */
    private PropertyAccessorInterface $defaultPropertyAccessor;

    /**
     * ReflectionPropertyAccessor constructor.
     *
     * @param PropertyAccessorInterface $propertyAccessor
     */
    public function __construct(PropertyAccessorInterface $propertyAccessor)
    {
        $this->defaultPropertyAccessor = $propertyAccessor;
    }

    /**
     * @param array|object $objectOrArray
     * @param string|PropertyPathInterface $propertyPath
     * @param mixed $value
     *
     * @return void
     *
     * @throws ReflectionException
     */
    public function setValue(&$objectOrArray, $propertyPath, $value): void
    {
        $reflectionProperty = $this->getReflectionProperty($objectOrArray, $propertyPath);

        if ($reflectionProperty === null) {
            throw new NoSuchPropertyException(sprintf(
                'Object of class "%s" doesn\'t have property of path "%s".',
                get_class($objectOrArray),
                $propertyPath
            ));
        }

        if ($reflectionProperty->getDeclaringClass()->getName() !== get_class($objectOrArray)) {
            $reflectionProperty->setAccessible(true);

            $reflectionProperty->setValue($objectOrArray, $value);

            return;
        }

        $setPropertyClosure = Closure::bind(
            function ($object) use ($propertyPath, $value): void {
                $object->{$propertyPath} = $value;
            },
            $objectOrArray,
            $objectOrArray
        );

        $setPropertyClosure($objectOrArray);
    }

    /**
     * @param array|object $objectOrArray
     * @param string|PropertyPathInterface $propertyPath
     *
     * @return mixed
     *
     * @throws ReflectionException
     */
    public function getValue($objectOrArray, $propertyPath)
    {
        $reflectionProperty = $this->getReflectionProperty($objectOrArray, $propertyPath);

        if ($reflectionProperty === null) {
            throw new NoSuchPropertyException(sprintf(
                'Object of class "%s" doesn\'t have property of path "%s".',
                get_class($objectOrArray),
                $propertyPath
            ));
        }

        if ($reflectionProperty->getDeclaringClass()->getName() !== get_class($objectOrArray)) {
            $reflectionProperty->setAccessible(true);

            return $reflectionProperty->getValue($objectOrArray);
        }

        $getPropertyClosure = Closure::bind(
            function ($object) use ($propertyPath) {
                return $object->{$propertyPath};
            },
            $objectOrArray,
            $objectOrArray
        );

        return $getPropertyClosure($objectOrArray);
    }

    /**
     * @param array|object $objectOrArray
     * @param string|PropertyPathInterface $propertyPath
     *
     * @return bool
     *
     * @throws ReflectionException
     */
    public function isWritable($objectOrArray, $propertyPath): bool
    {
        return $this->defaultPropertyAccessor->isWritable($objectOrArray, $propertyPath) || $this->propertyExists($objectOrArray, $propertyPath);
    }

    /**
     * @param array|object $objectOrArray
     * @param string|PropertyPathInterface $propertyPath
     *
     * @return bool
     *
     * @throws ReflectionException
     */
    public function isReadable($objectOrArray, $propertyPath): bool
    {
        return $this->defaultPropertyAccessor->isReadable($objectOrArray, $propertyPath) || $this->propertyExists($objectOrArray, $propertyPath);
    }

    /**
     * @param $objectOrArray
     * @param $propertyPath
     *
     * @return ReflectionProperty|null
     *
     * @throws ReflectionException
     */
    protected function getReflectionProperty($objectOrArray, $propertyPath): ?ReflectionProperty
    {
        if (false === is_object($objectOrArray)) {
            return null;
        }

        $reflectionClass = new ReflectionClass(get_class($objectOrArray));

        while ($reflectionClass instanceof ReflectionClass) {
            if ($reflectionClass->hasProperty($propertyPath)
                && $reflectionClass->getProperty($propertyPath)->isStatic() === false
            ) {
                return $reflectionClass->getProperty($propertyPath);
            }

            $reflectionClass = $reflectionClass->getParentClass();
        }

        return null;
    }

    /**
     * @param $objectOrArray
     * @param $propertyPath
     *
     * @return bool
     *
     * @throws ReflectionException
     */
    protected function propertyExists($objectOrArray, $propertyPath): bool
    {
        return $this->getReflectionProperty($objectOrArray, $propertyPath) !== null;
    }
}
