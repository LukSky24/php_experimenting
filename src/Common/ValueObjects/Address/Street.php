<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 28.05.2020
 */

namespace App\Common\ValueObjects\Address;

use App\Common\Exceptions\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Street
 *
 * @package App\Common\ValueObjects\Address
 *
 * @ORM\Embeddable
 */
class Street
{
    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string")
     */
    protected string $value;

    /**
     * Street constructor.
     *
     * @param string $street
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $street)
    {
        $length = strlen($street);

        if ($length < 3 || $length > 255) {
            throw new InvalidArgumentException('Street should be between 3 and 255 characters length, "' . $street . '" given.');
        }

        $this->value = $street;
    }

    /**
     * @param string $street
     *
     * @return Street
     *
     * @throws InvalidArgumentException
     */
    public static function create(string $street): Street
    {
        return new self(trim($street));
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
     * @param Street $street
     *
     * @return bool
     */
    public function isEqual(Street $street): bool
    {
        return $this->value = $street->getValue();
    }

}
