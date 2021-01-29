<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 20.05.2020
 */

namespace App\Common\Doctrine\Exceptions;

use App\Common\Translation\Exceptions\TranslatableException;

/**
 * Class EntityNotFoundException
 *
 * @package App\Common\Doctrine\Exceptions
 */
abstract class EntityNotFoundException extends TranslatableException
{
    /**
     * @var string
     */
    protected string $field;

    /**
     * @var string
     */
    protected string $value;

    /**
     * @var int
     */
    protected int $httpStatus = 404;

    /**
     * EntityNotFoundException constructor.
     *
     * @param string $class
     * @param string $value
     * @param string $field
     */
    public function __construct(string $class, string $value, string $field = 'id')
    {
        $classParts = explode('\\', $class);

        parent::__construct(array_pop($classParts) . ' with ' . $field . ' "' . $value . '" does not exists.');

        $this->field = $field;
        $this->value = $value;
    }
}
