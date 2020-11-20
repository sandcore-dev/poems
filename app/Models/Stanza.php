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
 * App\Models\Stanza
 *
 * @property int $id
 * @property int $poem_id
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $text
 * @property-read Collection|\App\Models\Line[] $lines
 * @property-read int|null $lines_count
 * @property-read \App\Models\Poem $poem
 * @method static \Illuminate\Database\Eloquent\Builder|Stanza newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stanza newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stanza query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stanza whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stanza whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stanza whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stanza wherePoemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stanza whereUpdatedAt($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
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
