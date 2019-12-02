<?php

namespace App\Pagination;

use App\Filtering\FilterDefinitionInterface;
use App\Filtering\ResourceFilterInterface;
use Hateoas\Representation\PaginatedRepresentation;

interface PaginationInterface
{
    public function paginate(Page $page, FilterDefinitionInterface $filter): PaginatedRepresentation;
    public function getResourceFilter(): ResourceFilterInterface;
    public function getRouteName(): string;
}