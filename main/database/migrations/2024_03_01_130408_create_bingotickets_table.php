<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBingoticketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bingoticket', function (Blueprint $table) {
            $table->id();
            $table->integer("achat_id");
            $table->integer("bingo_id");
            $table->integer("num_ticket");
            $table->string("number");
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
        Schema::dropIfExists('bingoticket');
    }
}
