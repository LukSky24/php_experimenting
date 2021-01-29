<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date: 25.11.2020
 */

namespace App\Users\Commands;

use App\Common\CQRS\CommandInterface;

/**
 * Class CreateRoleCommand
 *
 * @package App\Users\Commands
 */
class CreateRoleCommand implements CommandInterface
{

    /**
     * @var string
     */
    protected string $roleName;

    /**
     * CreateRoleCommand constructor.
     *
     * @param string $roleName
     */
    public function __construct(string $roleName)
    {
        $this->roleName = $roleName;
    }

    /**
     * @return string
     */
    public function getRoleName(): string
    {
        return $this->roleName;
    }

}
