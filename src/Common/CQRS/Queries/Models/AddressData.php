<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 19.10.2020
 */

namespace App\Common\CQRS\Queries\Models;

use App\Common\ValueObjects\Address\Address;

/**
 * Class AddressData
 *
 * @package App\Common\CQRS\Queries\Models
 */
class AddressData
{
    /**
     * @var string
     */
    public string $street;

    /**
     * @var string|null
     */
    public ?string $buildingNumber = null;

    /**
     * @var string|null
     */
    public ?string $flatnumber = null;

    /**
     * @var string
     */
    public string $postCode;

    /**
     * @var string
     */
    public string $city;

    /**
     * AddressData constructor.
     *
     * @param string $street
     * @param string $postCode
     * @param string $city
     * @param string|null $buildingNumber
     * @param string|null $flatnumber
     */
    public function __construct(
        string $street,
        string $postCode,
        string $city,
        ?string $buildingNumber = null,
        ?string $flatnumber = null
    ) {
        $this->street = $street;
        $this->buildingNumber = $buildingNumber;
        $this->postCode = $postCode;
        $this->city = $city;
        $this->flatnumber = $flatnumber;
    }

    /**
     * @param Address $address
     *
     * @return AddressData
     */
    public static function createFromEntity(Address $address): AddressData
    {
        return new self(
            $address->getStreet()->getValue(),
            $address->getPostCode()->getValue(),
            $address->getCity()->getValue(),
            ($address->getBuildingNumber()) ? $address->getBuildingNumber()->getValue() : null,
            ($address->getFlatNumber()) ? $address->getFlatNumber()->getValue() : null
        );
    }

}
