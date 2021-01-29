<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 25.11.2020
 */

namespace App\Users\Exceptions;

use App\Common\Doctrine\Exceptions\EntityNotFoundException;
use App\Users\Entities\Role;

/**
 * Class RoleNotFoundException
 *
 * @package App\Users\Exceptions
 */
class RoleNotFoundException extends EntityNotFoundException
{
    /**
     * @var string
     */
    protected string $messageKey = 'users.role_not_found_exception';

    /**
     * @var int|null
     */
    protected ?int $roleId;

    /**
     * @var string|null
     */
    protected ?string $name;

    /**
     * RoleNotFoundException constructor.
     *
     * @param int|null $roleId
     * @param string|null $name
     */
    public function __construct(?int $roleId = null, ?string $name = null)
    {
        $fields = [];
        $values = [];

        if (!is_null($roleId)) {
            $fields[] = 'roleId';
            $values[] = $roleId;
        }

        if (!is_null($name)) {
            $fields[] = 'name';
            $values[] = $name;
        }

        $this->roleId = $roleId;
        $this->name = $name;

        parent::__construct(Role::class, implode(', ', $values), implode(', ', $fields));

        $this->message = 'Role with fields [' . implode(', ', $fields) . '] of values [' . implode(', ', $values) . '] does not exists.';
    }

    /**
     * @param int|null $roleId
     * @param string|null $name
     *
     * @return RoleNotFoundException
     */
    public static function create(?int $roleId = null, ?string $name = null): RoleNotFoundException
    {
        return new self($roleId, $name);
    }

    /**
     * @return int|null
     */
    public function getRoleId(): ?int
    {
        return $this->roleId;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

}
