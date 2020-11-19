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
 * @property-read HasMany|Collection|Stanza[] stanzas
 * @property-read string text
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

    public function getTextAttribute(): string
    {
        $this->loadMissing('stanzas.lines');

        return $this->stanzas
            ->map(function (Stanza $stanza) {
                return $stanza->text;
            })
            ->join("\n\n");
    }

    public function saveText(string $text): self
    {
        if (!$this->exists) {
            throw new RuntimeException('Cannot save text on unsaved model');
        }

        $this->stanzas()->delete();

        Str::of($text)->split('/(\r?\n){2,}/')->each(function (string $text, int $order) {
            /** @var Stanza $stanza */
            $stanza = $this->stanzas()
                ->create(['order' => $order]);

            $stanza->saveText($text);
        });

        return $this;
    }
}
