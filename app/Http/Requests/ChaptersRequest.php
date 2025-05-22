<?php

namespace App\Http\Requests;

class ChaptersRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function createRules(): array
    {
        return [
            'book_id' => 'required|integer|exists:books,id',
            'title' => 'required|string|max:150',
            'chapter_number' => 'required|integer',
        ];
    }

    /**
     * @return string[]
     */
    public function updateRules(): array
    {
        return [
            'book_id' => 'required|integer|exists:books,id',
            'title' => 'required|string|max:150',
            'chapter_number' => 'required|integer',
        ];
    }
}
