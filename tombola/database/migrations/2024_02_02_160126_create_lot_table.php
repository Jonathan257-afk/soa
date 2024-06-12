<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lot', function (Blueprint $table) {
            $table->id();
            $table->integer("number");
            $table->string("libelle");
            $table->string("image");
            $table->string("link")->nullable();
            $table->integer("tombola_id");
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
        Schema::dropIfExists('lot');
    }
}
