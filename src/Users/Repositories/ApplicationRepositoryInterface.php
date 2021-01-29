<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 24.11.2020
 */

namespace App\Users\Repositories;

use App\Common\Doctrine\Repositories\RepositoryInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Interface ApplicationRepositoryInterface
 *
 * @package App\Users\Repositories
 */
interface ApplicationRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string $apiKey
     *
     * @return UserInterface|null
     */
    public function loadByApiKey(string $apiKey): ?UserInterface;
}
