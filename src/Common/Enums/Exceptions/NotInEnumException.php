<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 06.05.2020
 */

namespace App\Common\Enums\Exceptions;

use App\Common\Translation\Exceptions\TranslatableException;

/**
 * Class NotInEnumException
 *
 * @package App\Common\Enums\Exceptions
 */
class NotInEnumException extends TranslatableException
{
    /**
     * @var string
     */
    protected string $messageKey = 'common.enums.not_in_enum_exception';

    /**
     * @var string
     */
    protected string $class;

    /**
     * @var mixed
     */
    protected $value;

    /**
     * NotInEnumException constructor.
     *
     * @param string $class
     * @param mixed $value
     */
    public function __construct(string $class, $value)
    {
        parent::__construct('Value "' . $value . '" is not in "' . $class . '" enum.');

        $this->class = $class;
        $this->value = $value;

        $this->messageData = [
            '%value%' => $value
        ];
    }

    /**
     * @return string
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
