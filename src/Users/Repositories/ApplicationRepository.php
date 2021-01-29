<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 24.11.2020
 */

namespace App\Users\Repositories;

use App\Common\Doctrine\Repositories\AbstractRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class ApplicationRepository
 *
 * @package App\Users\Repositories
 */
class ApplicationRepository extends AbstractRepository implements ApplicationRepositoryInterface
{

    /**
     * @param string $apiKey
     *
     * @return UserInterface|null
     *
     * @throws NonUniqueResultException
     */
    public function loadByApiKey(string $apiKey): ?UserInterface
    {
        return $this->createQueryBuilder('a')
            ->leftJoin('a.roles', 'r')
            ->andWhere('a.apiKey = :apiKey')
            ->setParameter('apiKey', $apiKey)
            ->getQuery()
            ->getOneOrNullResult();
    }

}
