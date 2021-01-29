<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 07.06.2020
 */

namespace App\Common\CQRS\Buses;

use App\Common\CQRS\QueryInterface;
use Symfony\Component\Messenger\HandleTrait;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Class QueryBus
 *
 * @package App\Common\Messenger\Buses
 */
class QueryBus
{
    use HandleTrait;

    /**
     * QueryBus constructor.
     *
     * @param MessageBusInterface $messageBus
     */
    public function __construct(MessageBusInterface $messageBus)
    {
        $this->messageBus = $messageBus;
    }

    /**
     * @param QueryInterface $query
     *
     * @return mixed
     */
    public function dispatch(QueryInterface $query)
    {
        return $this->handle($query);
    }
}
