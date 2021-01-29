<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 13.05.2020
 */

namespace App\Common\ValueObjects\Address;

use App\Common\Exceptions\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class PostCode
 *
 * @package App\Common\ValueObjects\Address
 *
 * @ORM\Embeddable
 */
class PostCode
{
    /**
     * @var string
     *
     * @ORM\Column(name="post_code", type="string", length=6, options={"fixed"=true})
     */
    protected string $value;

    /**
     * PostCode constructor.
     *
     * @param string $postCode
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $postCode)
    {
        if (!preg_match('/^\d{2}-\d{3}$/', $postCode)) {
            throw new InvalidArgumentException('Post code should be in 00-000 format, "' . $postCode . '" given.');
        }

        $this->value = $postCode;
    }

    /**
     * @param string $postCode
     *
     * @return PostCode
     *
     * @throws InvalidArgumentException
     */
    public static function create(string $postCode): PostCode
    {
        return new self(trim($postCode));
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
     * @param PostCode $postCode
     *
     * @return bool
     */
    public function isEqual(PostCode $postCode): bool
    {
        return $this->value === $postCode->getValue();
    }
}
