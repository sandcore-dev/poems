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
 * App\Models\Poem
 *
 * @property int $id
 * @property int $author_id
 * @property string $title
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Author $author
 * @property-read string $text
 * @property-read Collection|\App\Models\Stanza[] $stanzas
 * @property-read int|null $stanzas_count
 * @method static \Illuminate\Database\Eloquent\Builder|Poem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Poem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Poem query()
 * @method static \Illuminate\Database\Eloquent\Builder|Poem whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Poem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Poem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Poem whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Poem whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Poem whereUpdatedAt($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
class Poem extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id',
        'author_id',
        'title',
        'slug',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class)
            ->withDefault();
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class)
            ->withDefault($this->author->language->toArray());
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
