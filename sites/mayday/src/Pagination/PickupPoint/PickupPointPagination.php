<?php

namespace App\Pagination\PickupPoint;

use App\Pagination\Store\StorePagination;

class PickupPointPagination extends StorePagination
{
    protected const ROUTE = 'get_pickup_points';
}