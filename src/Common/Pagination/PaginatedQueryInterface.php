<?php
/**
 * Author Łukasz Stadnik <lukasz.stadnik@nettle.pl>
 * Date:10.07.2020
 */

namespace App\Common\Pagination;

/**
 * Interface PaginatedQueryInterface
 *
 * @package App\Common\Pagination
 */
interface PaginatedQueryInterface
{
    /**
     * @return int|null
     */
    public function getPage(): ?int;

    /**
     * @return int|null
     */
    public function getPerPage(): ?int;

}
