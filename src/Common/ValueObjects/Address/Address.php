<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 13.05.2020
 */

namespace App\Common\ValueObjects\Address;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Address
 *
 * @package App\Common\ValueObjects\Address
 *
 * @ORM\Embeddable
 */
class Address
{
    /**
     * @var Street
     *
     * @ORM\Embedded(class="App\Common\ValueObjects\Address\Street", columnPrefix=false)
     */
    protected Street $street;

    /**
     * @var BuildingNumber|null
     *
     * @ORM\Embedded(class="App\Common\ValueObjects\Address\BuildingNumber", columnPrefix=false)
     */
    protected ?BuildingNumber $buildingNumber = null;

    /**
     * @var FlatNumber|null
     *
     * @ORM\Embedded(class="App\Common\ValueObjects\Address\FlatNumber", columnPrefix=false)
     */
    protected ?FlatNumber $flatNumber = null;

    /**
     * @var City
     *
     * @ORM\Embedded(class="App\Common\ValueObjects\Address\City", columnPrefix=false)
     */
    protected City $city;

    /**
     * @var PostCode
     *
     * @ORM\Embedded(class="App\Common\ValueObjects\Address\PostCode", columnPrefix=false)
     */
    protected PostCode $postCode;

    /**
     * Address constructor.
     *
     * @param Street $street
     * @param City $city
     * @param PostCode $postCode
     * @param BuildingNumber|null $buildingNumber
     * @param FlatNumber|null $flatNumber
     */
    public function __construct(
        Street $street,
        City $city,
        PostCode $postCode,
        ?BuildingNumber $buildingNumber = null,
        ?FlatNumber $flatNumber = null
    )
    {
        $this->street = $street;
        $this->buildingNumber = $buildingNumber;
        $this->city = $city;
        $this->postCode = $postCode;
        $this->flatNumber = $flatNumber;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return sprintf(
            '%s, %s %s',
            $this->getStreetLine(),
            $this->postCode->getValue(),
            $this->city->getValue()
        );
    }

    /**
     * @return string
     */
    public function getStreetLine(): string
    {
        return sprintf(
            '%s %s%s',
            $this->street->getValue(),
            $this->buildingNumber ? $this->buildingNumber->getValue() : '' ,
            $this->flatNumber ? ('/' . $this->flatNumber->getValue()) : ''
        );
    }

    /**
     * @return Street
     */
    public function getStreet(): Street
    {
        return $this->street;
    }

    /**
     * @return BuildingNumber|null
     */
    public function getBuildingNumber(): ?BuildingNumber
    {
        return $this->buildingNumber;
    }

    /**
     * @return FlatNumber|null
     */
    public function getFlatNumber(): ?FlatNumber
    {
        return $this->flatNumber;
    }

    /**
     * @return City
     */
    public function getCity(): City
    {
        return $this->city;
    }

    /**
     * @return PostCode
     */
    public function getPostCode(): PostCode
    {
        return $this->postCode;
    }

    /**
     * @param Address $address
     *
     * @return bool
     */
    public function isEqual(Address $address): bool
    {
        return $this->street->isEqual($address->getStreet())
            && (!is_null($this->buildingNumber) ? $this->buildingNumber->isEqual($address->getBuildingNumber()) : is_null($address->getBuildingNumber()))
            && (!is_null($this->flatNumber) ? $this->flatNumber->isEqual($address->getFlatNumber()) : is_null($address->getFlatNumber()))
            && $this->city->isEqual($address->getCity())
            && $this->postCode->isEqual($address->getPostCode());
    }
}
