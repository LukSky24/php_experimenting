<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 25.11.2020
 */

namespace App\Users\Repositories;

use App\Common\Doctrine\Repositories\AbstractRepository;
use App\Users\Entities\Role;
use App\Users\Exceptions\RoleNotFoundException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;

/**
 * Class RoleRepository
 *
 * @package App\Users\Repositories
 */
class RoleRepository extends AbstractRepository implements RoleRepositoryInterface
{

    /**
     * @param string $roleName
     *
     * @return bool
     *
     * @throws NoResultException
     * @throws NonUniqueResultException
     */
    public function existByRoleName(string $roleName): bool
    {
        $result = $this->createQueryBuilder('r')
            ->select('COUNT(r)')
            ->andWhere('r.role = :roleName')
            ->setParameter('roleName', $roleName)
            ->getQuery()
            ->getSingleScalarResult();

        return $result ? true : false;
    }

    /**
     * @param string $roleName
     *
     * @return Role
     *
     * @throws RoleNotFoundException
     */
    public function resolveByRoleName(string $roleName): Role
    {
        /** @var Role $role */
        $role = $this->findOneBy(['role' => $roleName]);

        if (!$role instanceof Role) {
            throw RoleNotFoundException::create(null, $roleName);
        }

        return $role;
    }

}
