<?php

declare(strict_types=1);

namespace App\Utils;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Request;

final class Paginate
{
    public static function paginate($items, $perPage = 10, $page = null): LengthAwarePaginator
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentPage = $page;
        $offset = ($currentPage * $perPage) - $perPage ;
        $itemsToShow = array_slice($items, $offset, $perPage);


        return new LengthAwarePaginator(
            $itemsToShow,
            $total,
            $perPage,
            $page,
            ['path' => Request::fullUrl()]
        );
    }
}
