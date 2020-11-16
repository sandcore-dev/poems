<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static int count()
 */
class Line extends Model
{
    use HasFactory;

    protected $fillable = [
        'stanza_id',
        'content',
        'alignment',
        'order',
    ];

    public function stanza(): BelongsTo
    {
        return $this->belongsTo(Stanza::class);
    }
}
