<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 03.07.2020
 */

namespace App\Common\ValueObjects;

use App\Common\Enums\AbstractEnum;
use App\Common\Enums\Exceptions\NotInEnumException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class VatRate
 *
 * @package App\Common\ValueObjects
 *
 * @ORM\Embeddable
 */
class VatRate extends AbstractEnum
{
    public const VAT_23 = '23';
    public const VAT_8 = '8';
    public const VAT_5 = '5';
    public const VAT_0 = '0';
    public const VAT_EXEMPT = 'zw';
    public const VAT_NOT_TAXABLE = 'np.';

    /**
     * @var string
     *
     * @ORM\Column(name="vat_rate", type="string")
     */
    protected string $value;

    /**
     * VatRate constructor.
     *
     * @param string $vatRate
     *
     * @throws NotInEnumException
     */
    public function __construct(string $vatRate)
    {
        if (!self::contains($vatRate)) {
            throw new NotInEnumException(self::class, $vatRate);
        }

        $this->value = $vatRate;
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
     * @return int
     */
    public function getMathValue(): int
    {
        return (int)$this->value;
    }

}
