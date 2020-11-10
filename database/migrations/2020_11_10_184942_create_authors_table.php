<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->enum('title', ['', 'Lord', 'Lady', 'Sir', 'Dame'])->default('');
            $table->string('first_name')->default('');
            $table->string('middle_names')->default('');
            $table->string('last_name')->default('');
            $table->year('birth_year')->nullable();
            $table->year('deceased_year')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();

            $table->unique([
                'title',
                'first_name',
                'middle_names',
                'last_name',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('authors');
    }
}
