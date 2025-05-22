<?php

namespace App\Http\Requests;

class BooksRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function createRules(): array
    {
        return [
            'bookshelf_id' => 'required|integer|exists:bookshelves,id',
            'title' => 'required|string|max:150',
            'author' => 'required|string|max:150',
            'published_year' => 'required|integer|date_format:Y',
        ];
    }

    /**
     * @return string[]
     */
    public function updateRules(): array
    {
        return [
            'bookshelf_id' => 'required|integer|exists:bookshelves,id',
            'title' => 'required|string|max:150',
            'author' => 'required|string|max:150',
            'published_year' => 'required|integer|date_format:Y',
        ];
    }
}
