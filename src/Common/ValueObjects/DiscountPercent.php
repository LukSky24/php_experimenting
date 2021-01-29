<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 23.09.2020
 */

namespace App\Common\ValueObjects;

use App\Common\Doctrine\Interfaces\NullableEmbeddableInterface;
use App\Common\Exceptions\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class DiscountPercent
 *
 * @package App\Common\ValueObjects
 *
 * @ORM\Embeddable
 */
class DiscountPercent implements NullableEmbeddableInterface
{
    /**
     * @var float
     *
     * @ORM\Column(name="discount_percent", type="decimal", precision=5, scale=2, options={"unsigned"=true})
     */
    protected float $value = 0;

    /**
     * DiscountPercent constructor.
     *
     * @param float $value
     *
     * @throws InvalidArgumentException
     */
    public function __construct(float $value)
    {
        if ($value < 0 || $value > 100) {
            throw new InvalidArgumentException('Discount percent should be between 0 and 100, "' . $value . '" given.');
        }

        $this->value = $value;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value . ' %';
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param DiscountPercent $discountPercent
     *
     * @return bool
     */
    public function isEqual(DiscountPercent $discountPercent): bool
    {
        return $this->value === $discountPercent->getValue();
    }

    /**
     * @return bool
     */
    public function isNull(): bool
    {
        return $this->value === null;
    }

}
