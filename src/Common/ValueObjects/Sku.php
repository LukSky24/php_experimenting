<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 14.07.2020
 */

namespace App\Common\ValueObjects;

use App\Common\Exceptions\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Sku
 *
 * @package App\Core\Products\ValueObjects
 *
 * @ORM\Embeddable
 */
class Sku
{

    /**
     * @var string
     *
     * @ORM\Column(name="sku", type="string")
     */
    protected string $value;

    /**
     * Sku constructor.
     *
     * @param string $sku
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $sku)
    {
        if (!preg_match('/^[A-Za-z\-\d]{2,20}$/', $sku)) {
            throw new InvalidArgumentException('SKU can contain only alphanumeric characters (may contain dashes) and should be between 2 and 20 characters length, "' . $sku . '" given.');
        }

        $this->value = $sku;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param Sku $sku
     *
     * @return bool
     */
    public function isEqual(Sku $sku): bool
    {
        return $this->value === $sku->getValue();
    }

}
