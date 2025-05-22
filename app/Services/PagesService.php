<?php

namespace App\Services;

use App\Models\Chapter;
use App\Models\Page;
use Illuminate\Pagination\LengthAwarePaginator;

class PagesService extends BaseService
{
    /**
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->model = $page;
    }

    /**
     * @return LengthAwarePaginator
     */
    public function getPages(): LengthAwarePaginator
    {
        return $this->model
            ->query()
            ->with(['chapter:id,title'])
            ->select([
               'id', 'chapter_id', 'page_number', 'content'
            ])
            ->when(
                request()->filled('q'), fn($query) => $query
                ->where('page_number', 'like', '%' . request('q') . '%')
            )
            ->orderBy('id', 'desc')
            ->paginate(request('per_page', self::DEFAULT_LIMIT));
    }
}
