<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('shop_id');
            $table->dateTime('reservation_date');
            $table->unsignedInteger('people_count');
            $table->timestamps(); 
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}