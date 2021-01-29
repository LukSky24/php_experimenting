<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 06.05.2020
 */

namespace App\Common\ValueObjects;

use App\Common\Exceptions\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class PersonName
 *
 * @package App\Common\ValueObjects
 *
 * @ORM\Embeddable
 */
class PersonName
{
    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=50)
     */
    protected string $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=50)
     */
    protected string $lastName;

    /**
     * PersonName constructor.
     *
     * @param string $firstName
     * @param string $lastName
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $firstName, string $lastName)
    {
        $firstNameLength = strlen(trim($firstName));
        $lastNameLength = strlen(trim($lastName));

        if ($firstNameLength < 2 || $firstNameLength > 50 || ctype_space($firstName)) {
            throw new InvalidArgumentException('First name should be between 2 and 50 characters length, "' . $firstName . '" given.');
        }

        if ($lastNameLength < 2 || $lastNameLength > 50 || ctype_space($lastName)) {
            throw new InvalidArgumentException('Last name should be between 2 and 50 characters length, "' . $lastName . '" given.');
        }

        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->getFullName();
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->lastName . ' ' . $this->firstName;
    }

    /**
     * @param PersonName $fullName
     *
     * @return bool
     */
    public function isEqual(PersonName $fullName): bool
    {
        return $this->firstName === $fullName->getFirstName()
            && $this->lastName === $fullName->getLastName();
    }
}
