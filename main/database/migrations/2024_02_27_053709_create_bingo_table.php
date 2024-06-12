<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBingoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bingo', function (Blueprint $table) {
            $table->id();
            $table->datetime("dateDebut");
            $table->datetime("date");
            $table->string("libelle");
            $table->integer("montant");
            $table->integer("ticket");
            $table->integer("max");
            $table->integer("association_id");
            $table->string("tirage")->nullable();
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
        Schema::dropIfExists('bingo');
    }
}
