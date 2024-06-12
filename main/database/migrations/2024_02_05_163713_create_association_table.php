<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('association', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("logo")->nullable();
            $table->string('email')->unique();
            $table->string("stripe")->nullable();
            $table->integer("paypal_id")->nullable();
            $table->string("gpay")->nullable();
            $table->string("interet");
            $table->string("cerfa");
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
        Schema::dropIfExists('association');
    }
}
