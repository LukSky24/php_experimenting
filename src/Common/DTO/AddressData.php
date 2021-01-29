<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 13.05.2020
 */

namespace App\Common\DTO;

use App\Common\Validation\Constraints\Address as AddressAssert;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class AddressData
 *
 * @package App\Common\DTO
 */
class AddressData
{
    /**
     * @var string|null
     *
     * @Assert\NotBlank(message="common.address.street.not_blank")
     * @AddressAssert\Street
     */
    protected ?string $street;

    /**
     * @var string|null
     *
     * @Assert\NotBlank(message="common.address.city.not_blank")
     * @AddressAssert\City
     */
    protected ?string $city;

    /**
     * @var string|null
     *
     * @Assert\NotBlank(message="common.address.post_code.not_blank")
     * @AddressAssert\PostCode
     */
    protected ?string $postCode;

    /**
     * @param array $data
     *
     * @return AddressData
     */
    public static function createFromArray(array $data = []): AddressData
    {
        return (new self())
            ->setStreet($data['street'] ?? null)
            ->setCity($data['city'] ?? null)
            ->setPostCode($data['postCode'] ?? null);
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string|null $street
     *
     * @return AddressData
     */
    public function setStreet(?string $street): AddressData
    {
        $this->street = $street;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     *
     * @return AddressData
     */
    public function setCity(?string $city): AddressData
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPostCode(): ?string
    {
        return $this->postCode;
    }

    /**
     * @param string|null $postCode
     *
     * @return AddressData
     */
    public function setPostCode(?string $postCode): AddressData
    {
        $this->postCode = $postCode;

        return $this;
    }
}
