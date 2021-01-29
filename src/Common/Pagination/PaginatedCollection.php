<?php
/**
 * Author Rafał Grabosz <r.grabosz@rgisoft.pl>
 * Date: 18.05.2020
 */

namespace App\Common\Pagination;

use Traversable;

/**
 * Class PaginatedCollection
 *
 * @package App\Common\Pagination
 */
class PaginatedCollection
{
    /**
     * @var array
     */
    protected array $items;

    /**
     * @var int
     */
    protected int $currentPage;

    /**
     * @var int
     */
    protected int $perPage;

    /**
     * @var int
     */
    protected int $totalResults;

    /**
     * @var int
     */
    protected int $totalPages;

    /**
     * PaginatedCollection constructor.
     *
     * @param array $items
     * @param int $currentPage
     * @param int $perPage
     * @param int $totalResults
     * @param int $totalPages
     */
    public function __construct(array $items, int $currentPage, int $perPage, int $totalResults, int $totalPages)
    {
        $this->items = $items;
        $this->currentPage = $currentPage;
        $this->perPage = $perPage;
        $this->totalResults = $totalResults;
        $this->totalPages = $totalPages;
    }

    /**
     * @param iterable $getCurrentPageResults
     * @param int $currentPage
     * @param int $perPage
     * @param int $totalResults
     * @param int $totalPages
     *
     * @return PaginatedCollection
     */
    public static function createFromIterable(
        iterable $getCurrentPageResults,
        int $currentPage,
        int $perPage,
        int $totalResults,
        int $totalPages
    ): PaginatedCollection {
        /** @var Traversable $getCurrentPageResults */
        
        return new self(iterator_to_array($getCurrentPageResults), $currentPage, $perPage, $totalResults, $totalPages);
    }

    /**
     * @param array $getCurrentPageResults
     * @param int $currentPage
     * @param int $perPage
     * @param int $totalResults
     * @param int $totalPages
     *
     * @return PaginatedCollection
     */
    public static function createFromArray(
        array $getCurrentPageResults,
        int $currentPage,
        int $perPage,
        int $totalResults,
        int $totalPages
    ): PaginatedCollection {
        return new self($getCurrentPageResults, $currentPage, $perPage, $totalResults, $totalPages);
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @return int
     */
    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * @return int
     */
    public function getTotalResults(): int
    {
        return $this->totalResults;
    }

    /**
     * @return int
     */
    public function getTotalPages(): int
    {
        return $this->totalPages;
    }
}
