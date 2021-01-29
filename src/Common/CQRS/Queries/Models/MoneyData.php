<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 20.10.2020
 */

namespace App\Common\CQRS\Queries\Models;

use App\Common\ValueObjects\Money;

/**
 * Class MoneyData
 *
 * @package App\Common\CQRS\Queries\Models
 */
class MoneyData
{
    /**
     * @var float
     */
    public float $amount;

    /**
     * @var string
     */
    public string $currency = 'PLN';

    /**
     * MoneyData constructor.
     *
     * @param float $amount
     * @param string $currency
     */
    public function __construct(float $amount, string $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @param Money $money
     *
     * @return MoneyData
     */
    public static function createFromEntity(Money $money): MoneyData
    {
        return new self ($money->getAmount(), $money->getCurrency());
    }

}
