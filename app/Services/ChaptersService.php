<?php

namespace App\Services;

use App\Models\Chapter;
use Illuminate\Pagination\LengthAwarePaginator;

class ChaptersService extends BaseService
{
    /**
     * @param Chapter $chapter
     */
    public function __construct(Chapter $chapter)
    {
        $this->model = $chapter;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getChapters(): LengthAwarePaginator
    {
        return $this->model
            ->query()
            ->with(['book:id,title'])
            ->select([
               'id', 'book_id', 'title', 'chapter_number'
            ])
            ->when(
                request()->filled('q'), fn($query) => $query
                ->where('title', 'like', '%' . request('q') . '%')
            )
            ->orderBy('id', 'desc')
            ->paginate(request('per_page', self::DEFAULT_LIMIT));
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getChaptersWithPageContent(): LengthAwarePaginator
    {
        return $this->model
            ->query()
            ->with(['book:id,title', 'pages:id,chapter_id,page_number,content'])
            ->select([
               'id', 'book_id', 'title', 'chapter_number'
            ])
            ->when(
                request()->filled('q'), fn($query) => $query
                ->where('title', 'like', '%' . request('q') . '%')
            )
            ->orderBy('id', 'desc')
            ->paginate(request('per_page', self::DEFAULT_LIMIT));
    }
}
