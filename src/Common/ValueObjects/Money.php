<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 21.05.2020
 */

namespace App\Common\ValueObjects;

use App\Common\Doctrine\Interfaces\NullableEmbeddableInterface;
use App\Common\Exceptions\InvalidArgumentException;
use App\Common\Exceptions\LogicException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Money
 *
 * @package App\Common\ValueObjects
 *
 * @ORM\Embeddable
 */
class Money implements NullableEmbeddableInterface
{
    /**
     * @var float|null
     *
     * @ORM\Column(name="amount", type="decimal", precision=15, scale=2, nullable=true)
     */
    protected ?float $amount;

    /**
     * @var string|null
     *
     * @ORM\Column(name="currency", type="string", length=3, options={"fixed"=true}, nullable=true)
     */
    protected ?string $currency = 'PLN';

    /**
     * Money constructor.
     *
     * @param float|null $amount
     * @param string|null $currency
     *
     * @throws InvalidArgumentException
     */
    public function __construct(?float $amount = null, ?string $currency = 'PLN')
    {
        if (strlen($currency) !== 3) {
            throw new InvalidArgumentException('Currency should be 3 characters length, "' . $currency . '" given.');
        }

        $this->amount = round($amount, 2);
        $this->currency = strtoupper($currency);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return number_format($this->amount, 2, ',', ' ') . ' ' . $this->currency;
    }

    /**
     * @return float|null
     */
    public function getAmount(): ?float
    {
        return $this->amount;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param Money $money
     *
     * @return bool
     *
     * @throws LogicException
     */
    public function isEqual(Money $money): bool
    {
        if ($this->currency !== $money->getCurrency()) {
            throw new LogicException('Cannot compare moneys with different currency.');
        }

        return $this->amount === $money->getAmount();
    }

    /**
     * @param float|Money $money
     *
     * @return Money
     *
     * @throws InvalidArgumentException
     * @throws LogicException
     */
    public function add($money): Money
    {
        if (is_numeric($money)) {
            return new self($this->amount + $money, $this->currency);
        }
        if ($money instanceof self) {

            if ($this->currency !== $money->getCurrency()) {
                throw new LogicException('Cannot add moneys with different currency.');
            }

            return new self($this->amount + $money->getAmount(), $this->currency);
        }
        throw new InvalidArgumentException('Argument must be numeric or Money instance, '.(is_object($money) ? get_class($money) : gettype($money)).' given.');
    }

    /**
     * @param float|Money $money
     *
     * @return Money
     *
     * @throws InvalidArgumentException
     * @throws LogicException
     */
    public function sub($money): Money
    {
        if (is_numeric($money)) {
            return new self($this->amount - $money, $this->currency);
        }
        if ($money instanceof self) {

            if ($this->currency !== $money->getCurrency()) {
                throw new LogicException('Cannot subtract moneys with different currency.');
            }

            return new self($this->amount - $money->getAmount(), $this->currency);
        }
        throw new InvalidArgumentException('Argument must be numeric or Money instance, '.(is_object($money) ? get_class($money) : gettype($money)).' given.');

    }

    /**
     * @param float $multiplier
     *
     * @return Money
     *
     * @throws InvalidArgumentException
     */
    public function multiply(float $multiplier): Money
    {
        return new self($this->amount * $multiplier, $this->currency);
    }

    /**
     * @param float $divider
     *
     * @return Money
     *
     * @throws InvalidArgumentException
     */
    public function divide(float $divider): Money
    {
        return new self($this->amount / $divider, $this->currency);
    }

    /**
     * @param Money $money
     *
     * @return bool
     *
     * @throws LogicException
     */
    public function isLowerThan(Money $money): bool
    {
        if ($this->currency !== $money->getCurrency()) {
            throw new LogicException('Cannot compare moneys with different currency.');
        }

        return $this->amount < $money->getAmount();
    }

    /**
     * @param Money $money
     *
     * @return bool
     *
     * @throws LogicException
     */
    public function isGreaterThan(Money $money): bool
    {
        if ($this->currency !== $money->getCurrency()) {
            throw new LogicException('Cannot compare moneys with different currency.');
        }

        return $this->amount > $money->getAmount();
    }

    /**
     * @return bool
     */
    public function isNull(): bool
    {
        return $this->amount === null;
    }

}
