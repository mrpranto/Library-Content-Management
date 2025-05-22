<?php

namespace App\Services;

use App\Models\Book;
use Illuminate\Pagination\LengthAwarePaginator;

class BooksService extends BaseService
{
    /**
     * @param Book $book
     */
    public function __construct(Book $book)
    {
        $this->model = $book;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getBooks(): LengthAwarePaginator
    {
        return $this->model
            ->query()
            ->with(['bookShelf:id,name'])
            ->select([
                'id', 'bookshelf_id', 'title', 'author', 'published_year'
            ])
            ->when(
                request()->filled('q'), fn($query) => $query
                ->where('title', 'like', '%' . request('q') . '%')
                ->orWhere('author', 'like', '%' . request('q') . '%')
                ->orWhere('published_year', 'like', '%' . request('q') . '%')
            )
            ->orderBy('id', 'desc')
            ->paginate(request('per_page', self::DEFAULT_LIMIT));
    }


    /**
     * @return LengthAwarePaginator
     */
    public function searchBooks(): LengthAwarePaginator
    {
        return $this->model
            ->query()
            ->with(['bookShelf:id,name'])
            ->select([
                'id', 'bookshelf_id', 'title', 'author', 'published_year'
            ])
            ->when(
                request()->filled('q'), fn($query) => $query
                ->where('title', 'like', '%' . request('q') . '%')
                ->orWhere('author', 'like', '%' . request('q') . '%')
            )
            ->orderBy('id', 'desc')
            ->paginate(request('per_page', self::DEFAULT_LIMIT));
    }
}
