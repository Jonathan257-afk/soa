<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBienfetaireTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bienfetaire', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("first_name")->nullable();
            $table->string("email")->nullable();
            $table->string("tel")->nullable();
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
        Schema::dropIfExists('bienfetaire');
    }
}
