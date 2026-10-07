<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'stanza_id',
    'content',
    'alignment',
    'order',
])]
class Line extends Model
{
    use HasFactory;

    public function stanza(): BelongsTo
    {
        return $this->belongsTo(Stanza::class);
    }

    public function content(): Attribute
    {
        return Attribute::make(
            get: fn(string $value) => trim($value),
            set: fn(string $value) => [
                'content' => trim($value),
            ],
        );
    }
}
