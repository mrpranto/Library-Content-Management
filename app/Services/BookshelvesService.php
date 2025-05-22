<?php

namespace App\Services;

use App\Models\Bookshelf;
use Illuminate\Pagination\LengthAwarePaginator;

class BookshelvesService extends BaseService
{
    /**
     * @param Bookshelf $bookshelves
     */
    public function __construct(Bookshelf $bookshelves)
    {
        $this->model = $bookshelves;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getBookshelves(): LengthAwarePaginator
    {
        return $this->model
            ->query()
            ->select(['id', 'name', 'location'])
            ->when(
                request()->filled('q'), fn($query) => $query
                ->where('name', 'like', '%' . request('q') . '%')
                ->orWhere('location', 'like', '%' . request('q') . '%')
            )
            ->orderBy('id', 'desc')
            ->paginate(request('per_page', self::DEFAULT_LIMIT));
    }
}
