<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountIdDiscountHistoryAndTotalInCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->integer('discount_id')->unsigned()->nullable()->after('midtrans_booking_code');
            $table->decimal('discount_amount', 16, 2)->nullable()->after('discount_id');
            $table->decimal('total', 16, 2)->default(0)->after('discount_amount');

            $table->foreign('discount_id')
                ->references('id')
                ->on('discounts')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
            $table->dropColumn('discount_id');
            $table->dropColumn('discount_amount');
            $table->dropColumn('total');
        });
    }
}
