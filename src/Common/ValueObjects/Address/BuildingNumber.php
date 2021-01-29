<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 11.09.2020
 */

namespace App\Common\ValueObjects\Address;

use App\Common\Doctrine\Interfaces\NullableEmbeddableInterface;
use App\Common\Exceptions\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class BuildingNumber
 *
 * @package App\Common\ValueObjects\Address
 *
 * @ORM\Embeddable
 */
class BuildingNumber implements NullableEmbeddableInterface
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="building_number", type="string", length=50, nullable=true)
     */
    protected ?string $value = null;

    /**
     * BuildingNumber constructor.
     *
     * @param string $buildingNumber
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $buildingNumber)
    {
        if ($buildingNumber !== null) {
            $length = strlen($buildingNumber);

            if ($length < 1 || $length > 50) {
                throw new InvalidArgumentException(
                    'Building Number should be between 1 and 50 characters length, "' . $buildingNumber . '" given.'
                );
            }
        }

        $this->value = $buildingNumber;
    }

    /**
     * @param string $buildingNumber
     *
     * @return BuildingNumber
     *
     * @throws InvalidArgumentException
     */
    public static function create(string $buildingNumber): BuildingNumber
    {
        return new self(trim($buildingNumber));
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param BuildingNumber $buildingNumber
     *
     * @return bool
     */
    public function isEqual(BuildingNumber $buildingNumber): bool
    {
        return $this->value = $buildingNumber->getValue();
    }

    /**
     * @return bool
     */
    public function isNull(): bool
    {
        return $this->value === null;
    }

}

