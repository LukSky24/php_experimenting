<?php
/**
 * Author: Paweł Paliński<pawel.palinski@nettle.pl>
 * Date: 15.11.2020
 */

namespace App\Common\ValueObjects;

use App\Common\Doctrine\Interfaces\NullableEmbeddableInterface;
use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;

/**
 * Class Bloz
 *
 * @package App\Common\ValueObjects
 *
 * @ORM\Embeddable
 */
class Bloz implements NullableEmbeddableInterface
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="bloz", type="string", options={"fixed"=true}, nullable=true)
     */
    protected ?string $value = null;

    /**
     * Bloz constructor.
     *
     * @param string|null $bloz
     */
    public function __construct(?string $bloz)
    {
        if (!is_null($bloz) && (strlen($bloz) !== 7 || !ctype_digit($bloz))) {
            throw new InvalidArgumentException('Bloz should be 7-characters digit string , "' . $bloz . '" given.');
        }

        $this->value = $bloz;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->value;
    }

    /**
     * @return string|null
     */
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param Bloz $bloz
     *
     * @return bool
     */
    public function isEqual(Bloz $bloz): bool
    {
        return $this->value === $bloz->getValue();
    }

    /**
     * @return bool
     */
    public function isNull(): bool
    {
        return $this->value === null;
    }
}
