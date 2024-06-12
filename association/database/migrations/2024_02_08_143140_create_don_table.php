<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('don', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->nullable();
            $table->integer("bienfetaire_id")->nullable();
            $table->integer("achat_id")->nullable();
            $table->integer("tombola_id")->nullable();
            $table->integer("bingo_id")->nullable();
            $table->integer("montant");
            $table->integer("ticket");
            $table->integer("numero")->nullable();
            $table->integer("association_id")->nullable();
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
        Schema::dropIfExists('don');
    }
}
