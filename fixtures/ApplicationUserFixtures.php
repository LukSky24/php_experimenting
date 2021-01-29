<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 25.11.2020
 */

namespace App\DataFixtures;

use App\Users\Entities\Application;
use App\Users\Entities\Role;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

/**
 * Class ApplicationUserFixtures
 *
 * @package App\DataFixtures
 */
class ApplicationUserFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager): void
    {
        $application = new Application('Admin');

        /** @var Role $role */
        $role = $this->getReference(RoleFixtures::ROLE_PREFIX . 0);

        $application->setApiKey('1cbf1b0e5efc3f8e2009453d282fd74eee52b011');
        $application->addRole($role);

        $manager->persist($application);
        $manager->flush();
    }

    /**
     * @return string[]
     */
    public function getDependencies(): array
    {
        return [
            RoleFixtures::class
        ];
    }

}
