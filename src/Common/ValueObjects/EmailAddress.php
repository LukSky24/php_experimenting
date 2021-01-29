<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 06.05.2020
 */

namespace App\Common\ValueObjects;

use App\Common\Doctrine\Interfaces\NullableEmbeddableInterface;
use App\Common\Exceptions\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class EmailAddress
 *
 * @package App\Common\ValueObjects
 *
 * @ORM\Embeddable
 */
class EmailAddress implements NullableEmbeddableInterface
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="email_address", type="string", nullable=true)
     */
    protected ?string $value;

    /**
     * EmailAddress constructor.
     *
     * @param string|null $emailAddress
     *
     * @throws InvalidArgumentException
     */
    public function __construct(?string $emailAddress = null)
    {
        if (($emailAddress !== null) && !filter_var(strtolower($emailAddress), FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException('Email address "' . $emailAddress . '" is not valid email address.');
        }

        $this->value = $emailAddress;
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
     * @param EmailAddress $emailAddress
     *
     * @return bool
     */
    public function isEqual(EmailAddress $emailAddress): bool
    {
        return $this->value === $emailAddress->getValue();
    }

    /**
     * @return bool
     */
    public function isNull(): bool
    {
        return $this->value === null;
    }

}
