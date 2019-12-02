<?php


namespace App\Pagination\Mayday;


use App\Filtering\FilterDefinitionInterface;
use App\Filtering\Mayday\MaydayResourceFilter;
use App\Filtering\ResourceFilterInterface;
use App\Pagination\Page;
use App\Pagination\PaginationInterface;
use App\Repository\MaydayRepository;
use Hateoas\Representation\CollectionRepresentation;
use Hateoas\Representation\PaginatedRepresentation;

class MaydayPagination  implements PaginationInterface
{
    private const ROUTE = 'maydays';

    /**
     * @var MaydayResourceFilter
     */
    private $resourceFilter;

    /**
     * @var MaydayRepository
     */
    private $repository;

    /**
     * MaydayPagination constructor.
     * @param MaydayResourceFilter $resourceFilter
     * @param MaydayRepository $repository
     */
    public function __construct(MaydayResourceFilter $resourceFilter, MaydayRepository $repository)
    {
        $this->resourceFilter = $resourceFilter;
        $this->repository = $repository;
    }

    /**
     * @param Page $page
     * @param FilterDefinitionInterface $filter
     * @return PaginatedRepresentation
     *
     */
    public function paginate(Page $page, FilterDefinitionInterface $filter): PaginatedRepresentation
    {
        $query = $this->getResourceFilter()->getQuery($filter);

        $mayday = $query->getQuery()->setFirstResult($page->getOffset())->setMaxResults($page->getLimit())->getResult();
        $totalHits = $query->select('count(mayday.id)')->getQuery()->getSingleScalarResult();

        $pages = 1;
        if($page->getLimit())
            $pages = (int) ceil($totalHits / $page->getLimit());

        return new PaginatedRepresentation(
            new CollectionRepresentation($mayday),
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