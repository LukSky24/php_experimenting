<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 24.11.2020
 */

namespace App\Users\Repositories;

use App\Common\Doctrine\Repositories\AbstractRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserRepository
 *
 * @package App\Users\Repositories
 */
class UserRepository extends AbstractRepository implements UserRepositoryInterface
{

    /**
     * @param string $username
     *
     * @return UserInterface
     *
     * @throws NonUniqueResultException
     */
    public function loadUserByUsername(string $username): UserInterface
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.username = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param string $username
     *
     * @return bool
     *
     * @throws NonUniqueResultException
     * @throws NoResultException
     */
    public function existByUsername(string $username): bool
    {
        $result = $this->createQueryBuilder('u')
            ->select('COUNT(u)')
            ->andWhere('u.username = :username')
            ->setParameter('username', $username)
            ->getQuery()
            ->getSingleScalarResult();

        return $result ? true : false;
    }

}
