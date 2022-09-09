<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCardNumberCvcExpiredDateAndIsPaidColumnInCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->dropColumn('card_number');
            $table->dropColumn('expired_date');
            $table->dropColumn('cvc');
            $table->dropColumn('is_paid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->string('card_number', 20)->nullable();
            $table->string('cvc', 3)->nullable();
            $table->string('expired_date')->nullable();
            $table->boolean('is_paid')->default(false);
        });
    }
}
