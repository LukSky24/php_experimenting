<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 24.11.2020
 */

namespace App\Users\Entities;

use App\Common\Doctrine\Traits\EntityId;
use App\Common\Doctrine\Traits\Timestampable;
use App\Common\Exceptions\InvalidArgumentException;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Role
 *
 * @package App\Users\Entities
 *
 * @ORM\Entity(repositoryClass="App\Users\Repositories\RoleRepository")
 * @ORM\Table(name="roles", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="role_udx", columns={"role"})
 * })
 */
class Role
{
    use EntityId, Timestampable;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=100)
     */
    protected string $role;

    /**
     * Role constructor.
     *
     * @param string $role
     *
     * @throws InvalidArgumentException
     */
    public function __construct(string $role)
    {
        if (!preg_match('/^ROLE_[A-Z_]+$/', $role)) {
            throw new InvalidArgumentException('Role role does not match pattern ROLE_ROLENAME, "'. $role . '" given.');
        }

        $this->role = $role;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->role;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

}
