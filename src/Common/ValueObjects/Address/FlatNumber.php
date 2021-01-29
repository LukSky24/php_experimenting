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
 * Class FlatNumber
 *
 * @package App\Common\ValueObjects\Address
 *
 * @ORM\Embeddable
 */
class FlatNumber implements NullableEmbeddableInterface
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="flat_number", type="string", length=50, nullable=true)
     */
    protected ?string $value = null;

    /**
     * FlatNumber constructor.
     *
     * @param string|null $flatNumber
     *
     * @throws InvalidArgumentException
     */
    public function __construct(?string $flatNumber = null)
    {
        if ($flatNumber !== null) {
            $length = strlen($flatNumber);

            if ($length < 1 || $length > 50) {
                throw new InvalidArgumentException('Flat Number should be between 1 and 50 characters length, "' . $flatNumber . '" given.');
            }
        }

        $this->value = $flatNumber;
    }

    /**
     * @param string|null $flatNumber
     *
     * @return FlatNumber
     *
     * @throws InvalidArgumentException
     */
    public static function create(?string $flatNumber = null): FlatNumber
    {
        return ($flatNumber) ? new self(trim($flatNumber)) : new self(null);
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
     * @param FlatNumber $flatNumber
     *
     * @return bool
     */
    public function isEqual(FlatNumber $flatNumber): bool
    {
        return $this->value = $flatNumber->getValue();
    }

    /**
     * @return bool
     */
    public function isNull(): bool
    {
        return $this->value === null;
    }
}

