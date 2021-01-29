<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 25.11.2020
 */

namespace App\Users\Commands\Handlers;

use App\Common\CQRS\CommandHandlerInterface;
use App\Users\Commands\CreateApplicationUserCommand;
use App\Users\Entities\Application;
use App\Users\Exceptions\UsernameAlreadyExistsException;
use App\Users\Repositories\ApplicationRepositoryInterface;
use App\Users\Repositories\RoleRepositoryInterface;
use App\Users\Repositories\UserRepositoryInterface;
use Exception;

/**
 * Class CreateApplicationUserCommandHandler
 *
 * @package App\Users\Commands\Handlers
 */
class CreateApplicationUserCommandHandler implements CommandHandlerInterface
{

    /**
     * @var RoleRepositoryInterface
     */
    protected RoleRepositoryInterface $roleRepository;

    /**
     * @var UserRepositoryInterface
     */
    protected UserRepositoryInterface $userRepository;

    /**
     * @var ApplicationRepositoryInterface
     */
    protected ApplicationRepositoryInterface $applicationRepository;

    /**
     * CreateRoleCommandHandler constructor.
     *
     * @param RoleRepositoryInterface $roleRepository
     * @param UserRepositoryInterface $userRepository
     * @param ApplicationRepositoryInterface $applicationRepository
     */
    public function __construct(
        RoleRepositoryInterface $roleRepository,
        UserRepositoryInterface $userRepository,
        ApplicationRepositoryInterface $applicationRepository
    ) {
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
        $this->applicationRepository = $applicationRepository;
    }

    /**
     * @param CreateApplicationUserCommand $command
     *
     * @return Application
     *
     * @throws UsernameAlreadyExistsException
     * @throws Exception
     */
    public function __invoke(CreateApplicationUserCommand $command): Application
    {
        if ($this->userRepository->existByUsername($command->getUsername())) {
            throw new UsernameAlreadyExistsException($command->getUsername());
        }

        $application = new Application($command->getUsername());

        foreach ($command->getRoles() as $roleName) {
            $role = $this->roleRepository->resolveByRoleName($roleName);

            $application->addRole($role);
        }

        $application->setApiKey(bin2hex(random_bytes(64)));

        $this->applicationRepository->store($application);

        return $application;
    }

}
