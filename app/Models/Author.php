<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string title
 * @property string first_name
 * @property string middle_names
 * @property string last_name
 * @property int birth_year
 * @property int deceased_year
 * @property string slug
 * @property-read Poem[]|Collection poems
 * @property-read string full_name
 * @property-read string full_name_with_years
 * @method static int count()
 */
class Author extends Model
{
    use HasFactory;

    protected $fillable = [
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
        return "{$this->first_name} {$this->middle_names} {$this->last_name}";
    }

    public function getFullNameWithYearsAttribute(): string
    {
        if ($this->birth_year && $this->deceased_year) {
            return "{$this->full_name} ({$this->birth_year}-{$this->deceased_year})";
        }

        return $this->full_name;
    }
}
