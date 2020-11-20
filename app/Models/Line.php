<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\Line
 *
 * @property int $id
 * @property int $stanza_id
 * @property string $content
 * @property string $alignment
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Stanza $stanza
 * @method static \Illuminate\Database\Eloquent\Builder|Line newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Line newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Line query()
 * @method static \Illuminate\Database\Eloquent\Builder|Line whereAlignment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Line whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Line whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Line whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Line whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Line whereStanzaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Line whereUpdatedAt($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
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
