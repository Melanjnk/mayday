<?php

namespace App\Pagination\Store;

use App\Filtering\FilterDefinitionInterface;

use App\Filtering\Store\StoreFilterDefinition;
use App\Filtering\Store\StoreResourceFilter;
use App\Filtering\ResourceFilterInterface;
//use App\Pagination\AbstractPagination;
use App\Pagination\Page;
use App\Pagination\PaginationInterface;
use App\Repository\Elastica\RetailPointRepository;
use Hateoas\Representation\CollectionRepresentation;
use Hateoas\Representation\PaginatedRepresentation;

class StorePagination implements PaginationInterface
{
    private const ROUTE = 'get_stores';

    /**
     * @var StoreResourceFilter
     */
    private $resourceFilter;

    /**
     * @var RetailPointRepository
     */
    private $repository;

    public function __construct(StoreResourceFilter $resourceFilter, RetailPointRepository $repository)
    {
        $this->resourceFilter = $resourceFilter;
        $this->repository = $repository;
    }

    /**
     * @param Page $page
     * @param StoreFilterDefinition $filter
     * @return PaginatedRepresentation
     */
    public function paginate(Page $page, FilterDefinitionInterface $filter): PaginatedRepresentation
    {
        $query = $this->getResourceFilter()->getQuery($filter);
        $result = $this->repository->findBy($query, $page->getLimit(), $page->getOffset());

        $stores = $this->repository->deserialize($result);
        $totalHits = $result->getTotalHits();

        $pages = 1;
        if($page->getLimit())
            $pages = (int) ceil($totalHits / $page->getLimit());

        return new PaginatedRepresentation(
            new CollectionRepresentation($stores),
            $this->getRouteName(),
            $filter->getQueryParameters(),
            $page->getPage(),
            $page->getLimit(),
            $pages,
            null,
            null,
            true,
            $totalHits
        );
    }

    public function getResourceFilter(): ResourceFilterInterface
    {
        return $this->resourceFilter;
    }

    public function getRouteName(): string
    {
        return self::ROUTE;
    }
}