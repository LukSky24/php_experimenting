<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 13.05.2020
 */

namespace App\Common\Doctrine\Traits;

use App\Common\ValueObjects\VatId;
use Doctrine\ORM\Mapping as ORM;

/**
 * Trait HasVatId
 *
 * @package App\Common\Doctrine\Traits
 */
trait HasVatId
{
    /**
     * @var VatId
     *
     * @ORM\Embedded(class="App\Common\ValueObjects\VatId", columnPrefix=false)
     */
    protected VatId $vatId;

    /**
     * @return VatId
     */
    public function getVatId(): VatId
    {
        return $this->vatId;
    }

    /**
     * @param VatId $vatId
     *
     * @return $this
     */
    public function setVatId(VatId $vatId): self
    {
        $this->vatId = $vatId;

        return $this;
    }
}
