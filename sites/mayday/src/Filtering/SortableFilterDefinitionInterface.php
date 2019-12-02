<?php

namespace App\Filtering;

interface SortableFilterDefinitionInterface
{
    public function getSortByQuery(): ?string;
    public function getSortByArray(): ?array;
}