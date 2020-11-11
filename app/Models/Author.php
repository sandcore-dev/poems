<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
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

    public function poems(): HasMany
    {
        return $this->hasMany(Poem::class);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getFullNameWithYearsAttribute(): string
    {
        if ($this->birth_year && $this->deceased_year) {
            return "{$this->full_name} ({$this->birth_year}-{$this->deceased_year})";
        }

        return $this->full_name;
    }
}
