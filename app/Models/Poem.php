<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Poem extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'title',
        'slug',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}
