<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 06.05.2020
 */

namespace App\Common\Doctrine\Repositories;

use Doctrine\Persistence\ObjectRepository;

/**
 * Interface RepositoryInterface
 *
 * @package App\Common\Doctrine\Repositories
 */
interface RepositoryInterface extends ObjectRepository
{
    /**
     * @param object $entity
     * @param bool $flush
     *
     * @return void
     */
    public function store(object $entity, bool $flush = true): void;

    /**
     * @param object $entity
     * @param bool $flush
     *
     * @return void
     */
    public function remove(object $entity, bool $flush = true): void;

    /**
     * @return void
     */
    public function flush(): void;

    /**
     * @return void
     */
    public function clear(): void;
}
