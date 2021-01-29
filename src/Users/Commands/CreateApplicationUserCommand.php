<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 25.11.2020
 */

namespace App\Users\Commands;

use App\Common\CQRS\CommandInterface;

/**
 * Class CreateApplicationUserCommand
 *
 * @package App\Users\Commands
 */
class CreateApplicationUserCommand implements CommandInterface
{
    /**
     * @var string
     */
    protected string $username;

    /**
     * @var string[]
     */
    protected array $roles;

    /**
     * CreateApplicationUserCommand constructor.
     *
     * @param string $username
     * @param string[] $roles
     */
    public function __construct(string $username, array $roles)
    {
        $this->username = $username;
        $this->roles = $roles;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

}
