<?php

namespace App\Filtering;

use App\Filtering\FilterDefinitionInterface;
use Elastica\Query;

interface ResourceFilterInterface
{
    public function getQuery(FilterDefinitionInterface $filter);
}