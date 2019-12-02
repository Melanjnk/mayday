<?php

namespace App\Filtering;

abstract class AbstractFilterDefinition implements FilterDefinitionInterface
{
    protected static $QUERY_PARAMS_BLACKLIST = ['sortByArray'];

    public function getQueryParameters(): array
    {
        return array_diff_key(
            $this->getParameters(),
            array_flip($this->getQueryParamsBlacklist())
        );
    }

    public function getQueryParamsBlacklist(): array
    {
        return self::$QUERY_PARAMS_BLACKLIST;
    }

    public function addQueryParamBlacklist(string $paramName)
    {
        if(!in_array($paramName, self::$QUERY_PARAMS_BLACKLIST))
            self::$QUERY_PARAMS_BLACKLIST[] = $paramName;
    }
}