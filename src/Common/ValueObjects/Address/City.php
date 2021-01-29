<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 29.05.2020
 */

namespace App\Common\ValueObjects\Address;

use App\Common\Exceptions\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class City
 *
 * @package App\Common\ValueObjects\Address
 *
 * @ORM\Embeddable
 */
class City
{
    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=50)
     */
    protected string $value;

    /**
     * City constructor.
     *
     * @param string $city
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $city)
    {
        $length = strlen($city);

        if ($length < 2 || $length > 50) {
            throw new InvalidArgumentException('City should be between 2 and 50 characters length, "' . $city . '" given.');
        }

        $this->value = $city;
    }

    /**
     * @param string $city
     *
     * @return City
     *
     * @throws InvalidArgumentException
     */
    public static function create(string $city): City
    {
        return new self(trim($city));
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
     * @param City $city
     *
     * @return bool
     */
    public function isEqual(City $city): bool
    {
        return $this->value = $city->getValue();
    }

}
