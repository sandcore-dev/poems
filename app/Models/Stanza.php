<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static int count()
 */
class Stanza extends Model
{
    use HasFactory;

    protected $fillable = [
        'poem_id',
        'order',
    ];

    public function poem(): BelongsTo
    {
        return $this->belongsTo(Poem::class);
    }

    public function lines(): HasMany
    {
        return $this->hasMany(Line::class);
    }
}
