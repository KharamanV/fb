<?php

namespace App\Helpers;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class PaginateHelper
{
	/**
	 * Creates custom paginator from given items
	 *
	 * @param array $items Items, which need to paginate (posts)
	 * @param int $perPage Number of items per one page
	 * @return object Paginator which contains paginated items
	 */
	public static function paginate($items, $perPage)
	{
		$currentPage = LengthAwarePaginator::resolveCurrentPage();
        $items = collect($items);
		
        //Slice the collection to get the items to display in current page
        $currentPageResults = $items->slice(($currentPage - 1) * $perPage, $perPage)->all();

        //Create our paginator
        return new LengthAwarePaginator($currentPageResults, count($items), $perPage);
	}
}