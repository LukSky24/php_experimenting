<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 07.06.2020
 */

namespace App\Common\CQRS\Buses;

use App\Common\CQRS\CommandInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class CommandBus
 *
 * @package App\Common\Messenger\Buses
 */
class CommandBus
{
    use HandleTrait;

    /**
     * CommandBus constructor.
     *
     * @param MessageBusInterface $messageBus
     */
    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param CommandInterface $command
     *
     * @return mixed
     */
    public function dispatch(CommandInterface $command)
    {
        return $this->handle($command);
    }
}
