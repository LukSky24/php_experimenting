<?php
/**
 * Author Pavlo Yakovchuk <py@nettle.pl>
 * Date: 03.07.2020
 */

namespace App\Common\ValueObjects;

use App\Common\Exceptions\InvalidArgumentException;
use DateTimeImmutable;

/**
 * Class DatesRange
 *
 * @package App\Common\ValueObjects
 */
class DatesRange {

    /**
     * @var DateTimeImmutable|null
     */
    protected ?DateTimeImmutable $dateFrom;

    /**
     * @var DateTimeImmutable|null
     */
    protected ?DateTimeImmutable $dateTo;

    /**
     * DatesRange constructor.
     *
     * @param DateTimeImmutable|null $dateFrom
     * @param DateTimeImmutable|null $dateTo
     * @throws InvalidArgumentException
     */
    public function __construct(?DateTimeImmutable $dateFrom, ?DateTimeImmutable $dateTo)
    {
        if ($dateFrom === null && $dateTo === null) {
            throw new InvalidArgumentException('"Date from" and "date to" are empty.');
        }

        if ($dateFrom !== null && $dateTo !== null && $dateFrom->getTimestamp() > $dateTo->getTimestamp()) {
            throw new InvalidArgumentException('"Date from" is bigger than "date to".');
        }

        $this->dateFrom = $dateFrom;
        $this->dateTo = $dateTo;
    }

    /**
     * @param string|null $dateFrom
     * @param string|null $dateTo
     *
     * @return static
     *
     * @throws InvalidArgumentException
     */
    public static function createFromStrings(?string $dateFrom, ?string $dateTo): self
    {
        return new self(
            DateTimeImmutable::createFromFormat('Y-m-d', $dateFrom) ?: null,
            DateTimeImmutable::createFromFormat('Y-m-d', $dateTo) ?: null
        );
    }


    /**
     * @return DateTimeImmutable|null
     */
    public function getDateFrom(): ?DateTimeImmutable
    {
        return $this->dateFrom;
    }

    /**
     * @return DateTimeImmutable|null
     */
    public function getDateTo(): ?DateTimeImmutable
    {
        return $this->dateTo;
    }

}
