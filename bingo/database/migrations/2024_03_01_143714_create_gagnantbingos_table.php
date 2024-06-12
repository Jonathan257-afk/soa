<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGagnantbingosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gagnantbingo', function (Blueprint $table) {
            $table->id();
            $table->integer("bingoticket_id");
            $table->integer("bingo_id");
            $table->integer("lotbingo_id");
            $table->integer("gagnant_at");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gagnantbingo');
    }
}
