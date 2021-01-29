<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 25.11.2020
 */

namespace App\Users\Exceptions;

use App\Common\Translation\Exceptions\TranslatableException;

/**
 * Class UsernameAlreadyExistsException
 *
 * @package App\Users\Exceptions
 */
class UsernameAlreadyExistsException extends TranslatableException
{
    /**
     * @var string
     */
    protected string $messageKey = 'users.username_already_exists_exception';

    /**
     * @var string
     */
    protected string $username;

    /**
     * UsernameAlreadyExistsException constructor.
     *
     * @param string $username
     * @param int $httpStatus
     */
    public function __construct(string $username, int $httpStatus = 404)
    {
        parent::__construct('Application User with name "' . $username . '" already exists in system.');

        $this->username = $username;
        $this->httpStatus = $httpStatus;

        $this->messageData = [
            '%username%' => $username
        ];
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

}
