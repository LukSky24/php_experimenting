<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 25.11.2020
 */

namespace App\Users\Commands\Handlers;

use App\Common\CQRS\CommandHandlerInterface;
use App\Common\Exceptions\InvalidArgumentException;
use App\Users\Commands\CreateRoleCommand;
use App\Users\Entities\Role;
use App\Users\Exceptions\RoleNameAlreadyExistsException;
use App\Users\Repositories\RoleRepositoryInterface;

/**
 * Class CreateRoleCommandHandler
 *
 * @package App\Users\Commands\Handlers
 */
class CreateRoleCommandHandler implements CommandHandlerInterface
{
    /**
     * @var RoleRepositoryInterface
     */
    protected RoleRepositoryInterface $roleRepository;

    /**
     * CreateRoleCommandHandler constructor.
     *
     * @param RoleRepositoryInterface $roleRepository
     */
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /**
     * @param CreateRoleCommand $command
     *
     * @return Role
     *
     * @throws InvalidArgumentException
     * @throws RoleNameAlreadyExistsException
     */
    public function __invoke(CreateRoleCommand $command): Role
    {
        if ($this->roleRepository->existByRoleName($command->getRoleName())) {
            throw new RoleNameAlreadyExistsException($command->getRoleName());
        }

        $role = new Role($command->getRoleName());

        $this->roleRepository->store($role);

        return $role;
    }

}
