<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name');
            $table->integer('category_id')->unsigned();
            $table->text('description')->nullable();
            $table->decimal('Price_upper', 10, 2)->nullable();
            $table->decimal('Price_lower', 10, 2)->nullable();
            $table->time('Start_time')->nullable();
            $table->time('Closings_time')->nullable();
            $table->string('Post_code')->nullable();
            $table->string('Address')->nullable();
            $table->string('Phone_number')->nullable();
            $table->string('Regular_holiday')->nullable();
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
        Schema::dropIfExists('shops');
    }
};
