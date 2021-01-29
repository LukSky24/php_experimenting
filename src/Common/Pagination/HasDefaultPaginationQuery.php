<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 18.05.2020
 */

namespace App\Common\Pagination;

use Doctrine\ORM\QueryBuilder;

/**
 * Interface HasDefaultPaginationQuery
 *
 * @package App\Common\Pagination
 */
interface HasDefaultPaginationQuery
{
    /**
     * @param PaginatedQueryInterface $query
     *
     * @return QueryBuilder
     */
    public function getPaginateQueryBuilder(PaginatedQueryInterface $query): QueryBuilder;

}
