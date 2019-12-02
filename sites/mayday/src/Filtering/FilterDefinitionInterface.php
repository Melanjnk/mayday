<?php

namespace App\Filtering;

interface FilterDefinitionInterface
{
    public function getQueryParameters(): array;
    public function getQueryParamsBlacklist(): array;
    public function addQueryParamBlacklist(string $paramName);
    public function getParameters(): array;
}