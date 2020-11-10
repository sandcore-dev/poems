<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStanzasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stanzas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poem_id');
            $table->unsignedInteger('order');
            $table->timestamps();

            $table->foreign('poem_id')->references('id')->on('poems');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stanzas');
    }
}
