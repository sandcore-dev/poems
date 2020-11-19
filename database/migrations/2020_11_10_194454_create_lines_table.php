<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stanza_id');
            $table->string('content');
            $table->enum('alignment', ['left', 'center', 'right'])->default('center');
            $table->unsignedInteger('order');
            $table->timestamps();

            $table->foreign('stanza_id')->references('id')->on('stanzas')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lines');
    }
}
