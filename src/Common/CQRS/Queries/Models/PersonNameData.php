<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 19.10.2020
 */

namespace App\Common\CQRS\Queries\Models;

use App\Common\ValueObjects\PersonName;

/**
 * Class PersonNameData
 *
 * @package App\Common\CQRS\Queries\Models
 */
class PersonNameData
{
    /**
     * @var string
     */
    public string $firstName;

    /**
     * @var string
     */
    public string $lastName;

    /**
     * @var string
     */
    public string $fullName;

    /**
     * PersonNameData constructor.
     *
     * @param string $firstName
     * @param string $lastName
     * @param string $fullName
     */
    public function __construct(string $firstName, string $lastName, string $fullName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->fullName = $fullName;
    }

    /**
     * @param PersonName $personName
     *
     * @return PersonNameData
     */
    public static function createFromEntity(PersonName $personName): PersonNameData
    {
        return new self($personName->getFirstName(), $personName->getLastName(), $personName->getFullName());
    }

}
