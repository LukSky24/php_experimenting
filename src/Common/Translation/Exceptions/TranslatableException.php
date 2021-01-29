<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 06.05.2020
 */

namespace App\Common\Translation\Exceptions;

use Exception;

/**
 * Class TranslatableException
 *
 * @package App\Common\Exceptions
 */
abstract class TranslatableException extends Exception
{
    /**
     * @var string
     */
    protected string $messageKey = '';

    /**
     * @var array
     */
    protected array $messageData = [];

    /**
     * @var int
     */
    protected int $httpStatus = 500;

    /**
     * @return string
     */
    public function getMessageKey(): string
    {
        return $this->messageKey;
    }

    /**
     * @return array
     */
    public function getMessageData(): array
    {
        return $this->messageData;
    }

    /**
     * @return int
     */
    public function getHttpStatus(): int
    {
        return $this->httpStatus;
    }
}
