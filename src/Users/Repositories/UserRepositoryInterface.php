<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 24.11.2020
 */

namespace App\Users\Repositories;

use App\Common\Doctrine\Repositories\RepositoryInterface;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;

/**
 * Interface UserRepositoryInterface
 *
 * @package App\Users\Repositories
 */
interface UserRepositoryInterface extends RepositoryInterface, UserLoaderInterface
{
    /**
     * @param string $username
     *
     * @return bool
     */
    public function existByUsername(string $username): bool;

}
