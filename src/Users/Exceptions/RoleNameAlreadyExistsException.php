<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 25.11.2020
 */

namespace App\Users\Exceptions;

use App\Common\Translation\Exceptions\TranslatableException;

/**
 * Class RoleNameAlreadyExistsException
 *
 * @package App\Users\Exceptions
 */
class RoleNameAlreadyExistsException extends TranslatableException
{
    /**
     * @var string
     */
    protected string $messageKey = 'users.role_name_already_exists_exception';

    /**
     * @var string
     */
    protected string $roleName;

    /**
     * RoleNameAlreadyExistsException constructor.
     *
     * @param string $roleName
     * @param int $httpStatus
     */
    public function __construct(string $roleName, int $httpStatus = 404)
    {
        parent::__construct('Role with name "' . $roleName . '" already exists in system.');

        $this->roleName = $roleName;
        $this->httpStatus = $httpStatus;

        $this->messageData = [
            '%roleName%' => $roleName
        ];
    }

    /**
     * @return string
     */
    public function getRoleName(): string
    {
        return $this->roleName;
    }

}
