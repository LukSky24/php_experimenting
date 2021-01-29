<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 06.05.2020
 */

namespace App\Common\Doctrine\Repositories;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\Mapping\MappingException;

/**
 * Class AbstractRepository
 *
 * @package App\Common\Doctrine\Repositories
 */
abstract class AbstractRepository extends EntityRepository implements RepositoryInterface
{
    /**
     * @param object $entity
     * @param bool $flush
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function store(object $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);

        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @param object $entity
     * @param bool $flush
     *
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(object $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);

        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @return void
     *
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function flush(): void
    {
        $this->_em->flush();
    }

    /**
     * @throws MappingException
     */
    public function clear(): void
    {
        $this->_em->clear();
    }
}
