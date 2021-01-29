<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date:03.07.2020
 */

namespace App\Common\ValueObjects;

use App\Common\Exceptions\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class NettleId
 *
 * @package App\Common\ValueObjects
 *
 * @ORM\Embeddable
 */
class NettleId
{

    /**
     * @var string
     *
     * @ORM\Column(name="nettle_id", type="string", length=11, options={"fixed"=true})
     */
    protected string $value;

    /**
     * NettleId constructor.
     *
     * @param string $nettleId
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $nettleId)
    {
        if (!preg_match('/^NT\d{9}$/', $nettleId)) {
            throw new InvalidArgumentException('Nettle ID should be in NT000000000 format, "' . $nettleId . '" given.');
        }

        $this->value = $nettleId;
    }

    /**
     * @param string $nettleId
     *
     * @return NettleId
     *
     * @throws InvalidArgumentException
     */
    public static function create(string $nettleId): NettleId
    {
        return new self($nettleId);
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
     * @param NettleId $nettleId
     *
     * @return bool
     */
    public function isEqual(NettleId $nettleId): bool
    {
        return $this->value === $nettleId->getValue();
    }

}
