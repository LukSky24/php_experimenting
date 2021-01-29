<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 12.11.2020
 */

namespace App\Common\ValueObjects;

use App\Common\Doctrine\Interfaces\NullableEmbeddableInterface;
use App\Common\Exceptions\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Ean
 *
 * @package App\Common\ValueObjects
 *
 * @ORM\Embeddable
 */
class Ean implements NullableEmbeddableInterface
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="ean", type="string", length=13, options={"fixed"=true}, nullable=true)
     */
    protected ?string $value = null;

    /**
     * Ean constructor.
     *
     * @param string $ean
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $ean)
    {
        if (strlen(trim($ean)) !== 13 || !ctype_digit(trim($ean))) {
            throw new InvalidArgumentException('EAN should be 13-characters digit string, "' . $ean . '" given.');
        }

        $this->value = $ean;
    }

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
     * @param Ean $ean
     *
     * @return bool
     */
    public function isEqual(Ean $ean): bool
    {
        return $this->value === $ean->getValue();
    }

    /**
     * @return bool
     */
    public function isNull(): bool
    {
        return $this->value === null;
    }

}
