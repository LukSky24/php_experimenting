<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 18.05.2020
 */

namespace App\Common\Pagination;

use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Doctrine\ORM\QueryAdapter;
use Pagerfanta\Pagerfanta;
use Traversable;

/**
 * Class Paginator
 *
 * @package App\Common\Pagination
 */
class Paginator
{
    /**
     * @var string
     */
    protected string $dataClass;

    /**
     * @param QueryBuilder $queryBuilder
     * @param int $pageNumber
     * @param int $perPage
     * @param bool $fetchJoinCollection
     * @param array $context
     *
     * @return PaginatedCollection
     */
    public function paginate(QueryBuilder $queryBuilder, int $pageNumber = 1, int $perPage = 20, bool $fetchJoinCollection = false, array $context = []): PaginatedCollection
    {
        $adapter = new QueryAdapter($queryBuilder, $fetchJoinCollection);

        $paginator = new Pagerfanta($adapter);

        $paginator->setMaxPerPage($perPage)
            ->setCurrentPage($pageNumber);

        /** @var Traversable $currentPageResults */
        $currentPageResults = $paginator->getCurrentPageResults();

        $currentPageResultsArray = iterator_to_array($currentPageResults);

        return PaginatedCollection::createFromArray(
            !empty($this->dataClass) ?
                array_map(fn($item) => call_user_func(array($this->dataClass, 'createFromEntity'), $item, $context), $currentPageResultsArray)
                : $currentPageResultsArray,
            $paginator->getCurrentPage(),
            $paginator->getMaxPerPage(),
            $paginator->getNbResults(),
            $paginator->getNbPages()
        );
    }

    /**
     * @param string $dataClass
     *
     * @return Paginator
     */
    public function setDataClass(string $dataClass): Paginator
    {
        $this->dataClass = $dataClass;

        return $this;
    }

}
