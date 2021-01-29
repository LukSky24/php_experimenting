<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 20.08.2020
 */

namespace App\Common\CQRS\Traits;

use App\Common\CQRS\Buses\CommandBus;
use App\Common\CQRS\CommandInterface;
use Exception;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

/**
 * Trait ExecutesCommands
 *
 * @package App\Common\CQRS\Traits
 */
trait ExecutesCommands
{
    /**
     * @var CommandBus
     */
    protected CommandBus $commandBus;

    /**
     * @param CommandInterface $command
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function executeCommand(CommandInterface $command)
    {
        try {
            return $this->commandBus->dispatch($command);
        } catch (HandlerFailedException $e) {
            while ($e instanceof HandlerFailedException) {
                $e = $e->getPrevious();
            }

            throw $e;
        }
    }
}
