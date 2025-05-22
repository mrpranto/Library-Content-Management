<?php

namespace App\Http\Requests;

class PagesRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function createRules(): array
    {
        return [
            'chapter_id' => 'required|integer|exists:chapters,id',
            'page_number' => 'required|integer',
            'content' => 'required|string',
        ];
    }

    /**
     * @return string[]
     */
    public function updateRules(): array
    {
        return [
            'chapter_id' => 'required|integer|exists:chapters,id',
            'page_number' => 'required|integer',
            'content' => 'required|string',
        ];
    }
}
