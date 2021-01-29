<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 21.05.2020
 */

namespace App\Common\Doctrine\Listeners;

use App\Common\Doctrine\Interfaces\NullableEmbeddableInterface;
use Symfony\Component\PropertyAccess\PropertyAccessorInterface;

/**
 * Class NullableEmbeddableEventListener
 *
 * @package App\Common\Doctrine\Listeners
 */
class NullableEmbeddableEventListener
{
    /**
     * @var PropertyAccessorInterface
     */
    protected PropertyAccessorInterface $propertyAccessor;

    /**
     * @var array
     */
    protected array $mappings = [];

    /**
     * NullableEmbeddableEventListener constructor.
     *
     * @param PropertyAccessorInterface $propertyAccessor
     */
    public function __construct(PropertyAccessorInterface $propertyAccessor)
    {
        $this->propertyAccessor = $propertyAccessor;
    }

    /**
     * @param $entity
     *
     * @return void
     */
    public function onPostLoad($entity): void
    {
        $key = str_replace('Proxies\\__CG__\\', '', get_class($entity));

        if (empty($this->mappings[$key])) {
            return;
        }

        $properties = $this->mappings[$key];

        foreach ($properties as $property) {
            $propertyPath = explode('.', $property);

            $obj = $entity;

            while (count($propertyPath) > 1) {
                $prop = array_shift($propertyPath);

                $obj = $this->propertyAccessor->getValue($obj, $prop);
            }

            $embeddable = $this->propertyAccessor->getValue($obj, $propertyPath[0]);

            if (!$embeddable instanceof NullableEmbeddableInterface) {
                continue;
            }

            if ($embeddable->isNull()) {
                $this->propertyAccessor->setValue($obj, $propertyPath[0], null);
            }
        }
    }

    /**
     * @param string $entityClass
     * @param string $property
     *
     * @return void
     */
    public function addMapping(string $entityClass, string $property): void
    {
        if (empty($this->mappings[$entityClass])) {
            $this->mappings[$entityClass] = [];
        }

        $this->mappings[$entityClass][] = $property;
    }
}
