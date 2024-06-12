<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTombolaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tombola', function (Blueprint $table) {
            $table->id();
            $table->datetime("dateDebut");
            $table->datetime("date");
            $table->string("libelle");
            $table->integer("montant");
            $table->integer("ticket");
            $table->integer("max");
            $table->integer("association_id");
            $table->string("useTirage", 10);
            $table->integer("debut");
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
        Schema::dropIfExists('tombola');
    }
}
