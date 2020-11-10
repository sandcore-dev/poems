<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
