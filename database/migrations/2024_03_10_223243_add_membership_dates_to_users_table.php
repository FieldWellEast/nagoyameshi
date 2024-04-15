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
        Schema::table('users', function (Blueprint $table) {
            $table->date('paid_membership_start_date')->nullable()->change();
            $table->date('paid_membership_update_date')->nullable();
            $table->date('paid_membership_cancel_date')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('paid_membership_start_date');
            $table->dropColumn('paid_membership_update_date');
            $table->dropColumn('paid_membership_cancel_date');
        });
    }
};
