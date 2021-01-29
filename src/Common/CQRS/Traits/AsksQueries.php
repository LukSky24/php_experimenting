<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 20.08.2020
 */

namespace App\Common\CQRS\Traits;

use App\Common\CQRS\Buses\QueryBus;
use App\Common\CQRS\QueryInterface;
use Exception;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

/**
 * Trait AsksQueries
 *
 * @package App\Common\CQRS\Traits
 */
trait AsksQueries
{
    /**
     * @var QueryBus
     */
    protected QueryBus $queryBus;

    /**
     * @param QueryInterface $query
     *
     * @return mixed
     *
     * @throws Exception
     */
    public function askQuery(QueryInterface $query)
    {
        try {
            return $this->queryBus->dispatch($query);
        } catch (HandlerFailedException $e) {
            while ($e instanceof HandlerFailedException) {
                $e = $e->getPrevious();
            }

            throw $e;
        }
    }
}
