<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Line;
use App\Models\Poem;
use App\Models\Stanza;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->state([
                'email' => 'webmaster@localhost',
            ])
            ->create();

        Author::factory()
            ->count(25)
            ->has(
                Poem::factory()
                    ->count(rand(5, 15))
                    ->has(
                        Stanza::factory()
                            ->count(rand(1, 5))
                            ->has(
                                Line::factory()
                                    ->count(rand(2, 6))
                            )
                    )
            )
            ->create();
    }
}
