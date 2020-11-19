<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use RuntimeException;

/**
 * @method static int count()
 * @property-read HasMany|Collection|Line[]
 * @property-read string text
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

    public function getTextAttribute(): string
    {
        $this->loadMissing('lines');

        return $this->lines
            ->map(function (Line $line) {
                return $line->content;
            })
            ->join("\n");
    }

    public function saveText(string $value): self
    {
        if (!$this->exists) {
            throw new RuntimeException('Cannot save text on unsaved model');
        }

        $this->lines()->delete();

        $this->lines()->createMany(
            Str::of($value)
                ->split('/\r?\n/')
                ->map(function (string $content, $order) {
                    return [
                        'content' => $content,
                        'order' => $order,
                    ];
                })
                ->all()
        );

        return $this;
    }
}
