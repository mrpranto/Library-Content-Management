<?php

namespace App\Http\Requests;

class BookshelvesRequest extends BaseRequest
{
    /**
     * @return string[]
     */
    public function createRules(): array
    {
        return [
            'name' => 'required|string|max:100|unique:bookshelves,name',
            'location' => 'required|string|max:150',
        ];
    }

    /**
     * @return string[]
     */
    public function updateRules(): array
    {
        return [
            'name' => 'required|string|max:100|unique:bookshelves,name,'.$this->route('bookshelf')->id,
            'location' => 'required|string|max:150',
        ];
    }
}
