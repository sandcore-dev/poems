<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeYearColumnTypesInAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('authors', function (Blueprint $table) {
            $table->unsignedDecimal('birth_year', 4, 0)->nullable()->change();
            $table->unsignedDecimal('deceased_year', 4, 0)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DECIMAL columns cannot be changed back to YEAR ones without possible errors or loss of data
    }
}
