<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static int count()
 */
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

    public function stanzas(): HasMany
    {
        return $this->hasMany(Stanza::class);
    }
}
