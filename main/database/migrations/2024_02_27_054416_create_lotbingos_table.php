<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotbingosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lotbingo', function (Blueprint $table) {
            $table->id();
            $table->integer("number");
            $table->string("libelle");
            $table->string("image");
            $table->string("link")->nullable();
            $table->integer("bingo_id");
            $table->integer("price");
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
        Schema::dropIfExists('lotbingo');
    }
}
