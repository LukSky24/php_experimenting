<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 03.08.19
 */

namespace App\Common\ValueObjects;

use App\Common\Doctrine\Interfaces\NullableEmbeddableInterface;
use App\Common\Exceptions\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class PhoneNumber
 *
 * @package App\Common\ValueObjects
 *
 * @ORM\Embeddable
 */
class PhoneNumber implements NullableEmbeddableInterface
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="phone_number", type="string", length=20, nullable=true)
     */
    protected ?string $value = null;

    /**
     * PhoneNumber constructor.
     *
     * @param string|null $phoneNumber
     *
     * @throws InvalidArgumentException
     */
    public function __construct(?string $phoneNumber = null)
    {
        if (!is_null($phoneNumber) && !preg_match('/^((\+)?\d{2})?\d{9}$/', $phoneNumber)) {
            throw new InvalidArgumentException('Phone number should contain 9 digits and optionally area code, "' . $phoneNumber . '" given.');
        }

        $this->value = $phoneNumber;
    }

    /**
     * @param string $phoneNumber
     *
     * @return PhoneNumber
     *
     * @throws InvalidArgumentException
     */
    public static function create(string $phoneNumber): PhoneNumber
    {
        return new self(trim($phoneNumber));
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
     * @param PhoneNumber $phoneNumber
     *
     * @return bool
     */
    public function isEqual(PhoneNumber $phoneNumber): bool
    {
        return $this->value === $phoneNumber->getValue();
    }

    /**
     * @return bool
     */
    public function isNull(): bool
    {
        return $this->value === null;
    }
}
