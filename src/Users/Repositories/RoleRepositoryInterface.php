<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 25.11.2020
 */

namespace App\Users\Repositories;

use App\Common\Doctrine\Repositories\RepositoryInterface;
use App\Users\Entities\Role;
use App\Users\Exceptions\RoleNotFoundException;

/**
 * Interface RoleRepositoryInterface
 *
 * @package App\Users\Repositories
 */
interface RoleRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $roleName
     *
     * @return bool
     */
    public function existByRoleName(string $roleName): bool;

    /**
     * @param string $roleName
     *
     * @return Role
     *
     * @throws RoleNotFoundException
     */
    public function resolveByRoleName(string $roleName): Role;
}
