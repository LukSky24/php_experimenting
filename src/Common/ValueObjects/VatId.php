<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 13.05.2020
 */

namespace App\Common\ValueObjects;

use App\Common\Exceptions\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class VatId
 *
 * @package App\Common\ValueObjects
 *
 * @ORM\Embeddable
 */
class VatId
{
    /**
     * @var string
     *
     * @ORM\Column(name="vat_id", type="string", length=10, options={"fixed"=true})
     */
    protected string $value;

    /**
     * VatId constructor.
     *
     * @param string $vatId
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $vatId)
    {
        if (strlen($vatId) !== 10 || !ctype_digit($vatId)) {
            throw new InvalidArgumentException('VAT ID should be 10-characters digit string, "' . $vatId . '" given.');
        }

        $this->value = $vatId;
    }

    /**
     * @param string $vatId
     *
     * @return VatId
     *
     * @throws InvalidArgumentException
     */
    public static function create(string $vatId): VatId
    {
        return new self(trim($vatId));
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @param VatId $vatId
     *
     * @return bool
     */
    public function isEqual(VatId $vatId): bool
    {
        return $this->value === $vatId->getValue();
    }
}
