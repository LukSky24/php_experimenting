<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 26.11.2020
 */

namespace App\DataFixtures;

use App\Users\Entities\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class RoleFixtures
 *
 * @package App\DataFixtures
 */
class RoleFixtures extends Fixture
{
    public const ROLE_PREFIX = 'core.role_';

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $role = new Role('ROLE_APPLICATION');

        $manager->persist($role);
        $this->setReference(self::ROLE_PREFIX . 0, $role);
        $manager->flush();
    }
}
