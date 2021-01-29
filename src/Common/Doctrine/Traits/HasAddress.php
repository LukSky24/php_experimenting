<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 13.05.2020
 */

namespace App\Common\Doctrine\Traits;

use App\Common\ValueObjects\Address\Address;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait HasAddress
 *
 * @package App\Common\Doctrine\Traits
 */
trait HasAddress
{
    /**
     * @var Address
     *
     * @ORM\Embedded(class="App\Common\ValueObjects\Address\Address", columnPrefix="address_")
     */
    protected Address $address;

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     *
     * @return $this
     */
    public function setAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }
}
