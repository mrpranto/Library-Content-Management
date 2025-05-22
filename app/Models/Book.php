<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    protected $fillable = [
        'bookshelf_id', 'title',
        'author', 'published_year'
    ];

    /**
     * @return BelongsTo
     */
    public function bookShelf(): BelongsTo
    {
        return $this->belongsTo(Bookshelf::class, 'bookshelf_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class, 'book_id', 'id');
    }
}
