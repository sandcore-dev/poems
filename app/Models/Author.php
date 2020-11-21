<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Author
 *
 * @property int $id
 * @property int|null $language_id
 * @property string $title
 * @property string $first_name
 * @property string $middle_names
 * @property string $last_name
 * @property string|null $birth_year
 * @property string|null $deceased_year
 * @property string $slug
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string $alphabetical_full_name
 * @property-read string $full_name
 * @property-read string $full_name_with_years
 * @property-read \App\Models\Language|null $language
 * @property-read Collection|\App\Models\Poem[] $poems
 * @property-read int|null $poems_count
 * @method static Builder|Author newModelQuery()
 * @method static Builder|Author newQuery()
 * @method static Builder|Author query()
 * @method static Builder|Author search($search)
 * @method static Builder|Author whereBirthYear($value)
 * @method static Builder|Author whereCreatedAt($value)
 * @method static Builder|Author whereDeceasedYear($value)
 * @method static Builder|Author whereFirstName($value)
 * @method static Builder|Author whereId($value)
 * @method static Builder|Author whereLanguageId($value)
 * @method static Builder|Author whereLastName($value)
 * @method static Builder|Author whereMiddleNames($value)
 * @method static Builder|Author whereSlug($value)
 * @method static Builder|Author whereTitle($value)
 * @method static Builder|Author whereUpdatedAt($value)
 * @mixin \Eloquent
 * @noinspection PhpFullyQualifiedNameUsageInspection
 * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
 */
class Author extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id',
        'title',
        'first_name',
        'middle_names',
        'last_name',
        'birth_year',
        'deceased_year',
        'slug',
    ];

    protected $casts = [
        'title' => 'string',
        'first_name' => 'string',
        'middle_names' => 'string',
        'last_name' => 'string',
    ];

    protected static function booted()
    {
        static::addGlobalScope('name', function (Builder $query) {
            $query
                ->orderBy('last_name')
                ->orderBy('first_name')
                ->orderBy('middle_names');
        });
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class)
            ->withDefault();
    }

    public function poems(): HasMany
    {
        return $this->hasMany(Poem::class);
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        if (empty($search)) {
            return $query;
        }

        return $query
            ->orWhere('first_name', 'like', "%{$search}%")
            ->orWhere('middle_names', 'like', "%{$search}%")
            ->orWhere('last_name', 'like', "%{$search}%");
    }

    public function getAlphabeticalFullNameAttribute(): string
    {
        return "{$this->last_name}, {$this->first_name} {$this->middle_names}";
    }

    public function getFullNameAttribute(): string
    {
        $fullName = [];

        if(in_array($this->title, config('poems.title.before_first_name'))) {
            $fullName[] = $this->title;
        }

        $fullName[] = $this->first_name;

        if ($this->middle_names) {
            $fullName[] = $this->middle_names;
        }

        if(in_array($this->title, config('poems.title.before_last_name'))) {
            $fullName[count($fullName) - 1] .= ',';
            $fullName[] = $this->title;
        }

        $fullName[] = $this->last_name;

        return implode(' ', $fullName);
    }

    public function getFullNameWithYearsAttribute(): string
    {
        if ($this->birth_year && $this->deceased_year) {
            return "{$this->full_name} ({$this->birth_year}-{$this->deceased_year})";
        }

        return $this->full_name;
    }
}
