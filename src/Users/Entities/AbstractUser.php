<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 24.11.2020
 */

namespace App\Users\Entities;

use App\Common\Doctrine\Traits\EntityId;
use App\Common\Doctrine\Traits\Timestampable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractUser
 *
 * @package App\Users\Entities
 *
 * @ORM\Entity(repositoryClass="App\Users\Repositories\UserRepository")
 * @ORM\Table(name="users", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="username_udx", columns={"username"}),
 *     @ORM\UniqueConstraint(name="api_key_udx", columns={"api_key"})
 * })
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *     "application" = "App\Users\Entities\Application",
 * })
 */
abstract class AbstractUser implements UserInterface
{
    use EntityId, Timestampable;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string")
     */
    protected string $username;

    /**
     * @var Collection|Role[]
     *
     * @ORM\ManyToMany(targetEntity="App\Users\Entities\Role")
     * @ORM\JoinTable(
     *      name="user_roles",
     *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     */
    protected Collection $roles;

    /**
     * AbstractUser constructor.
     *
     * @param string $username
     */
    public function __construct(string $username)
    {
        $this->username = $username;

        $this->roles = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return '#' . $this->id . ' ' . $this->username;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return AbstractUser
     */
    public function setUsername(string $username): AbstractUser
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return array_map(static fn($item) => (string)$item, $this->roles->toArray());
    }

    /**
     * @param array $roles
     *
     * @return Application
     */
    public function setRoles(array $roles): AbstractUser
    {
        $this->roles = new ArrayCollection($roles);

        return $this;
    }

    /**
     * @param Role $role
     *
     * @return AbstractUser
     */
    public function addRole(Role $role): AbstractUser
    {
        $this->roles->add($role);

        return $this;
    }

    /**
     * @param Role $role
     *
     * @return AbstractUser
     */
    public function removeRole(Role $role): AbstractUser
    {
        $this->roles->removeElement($role);

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return '';
    }

    /**
     * @return string|null
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @return void
     */
    public function eraseCredentials(): void
    {
        // do nothing
    }

}
