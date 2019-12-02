<?php

namespace App\Filtering;

abstract class AbstractFilterDefinitionFactory implements FilterDefinitionFactoryInterface
{
    private const SORT_ORDER_DELIMITER = ' ';

    public function sortQueryToArray(?string $sortByQuery): ?array
    {
        if (null === $sortByQuery) {
            return null;
        }

        $sortByArray = array_intersect_key(array_reduce(
            explode(',', $sortByQuery),
            function ($carry, $item) {
                list($by, $order) = array_replace(
                    [1 => 'desc'],
                    explode(
                        self::SORT_ORDER_DELIMITER,
                        preg_replace('/\s+/', ' ', $item)
                    )
                );

                $carry[$by] = $order;

                return $carry;
            },
            []
        ), array_flip($this->getAcceptedSortFields()));

        return $sortByArray;
    }
}