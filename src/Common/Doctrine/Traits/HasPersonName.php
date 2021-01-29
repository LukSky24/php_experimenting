<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 06.05.2020
 */

namespace App\Common\Doctrine\Traits;

use App\Common\ValueObjects\PersonName;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait HasPersonName
 *
 * @package App\Common\Doctrine\Traits
 */
trait HasPersonName
{
    /**
     * @var PersonName
     *
     * @ORM\Embedded(class="App\Common\ValueObjects\PersonName", columnPrefix=false)
     */
    protected PersonName $name;

    /**
     * @return PersonName
     */
    public function getPersonName(): PersonName
    {
        return $this->name;
    }

    /**
     * @param PersonName $name
     *
     * @return $this
     */
    public function setPersonName(PersonName $name): self
    {
        $this->name = $name;

        return $this;
    }
}
