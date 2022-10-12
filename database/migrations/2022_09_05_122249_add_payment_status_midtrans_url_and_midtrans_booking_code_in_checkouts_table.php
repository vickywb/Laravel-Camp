<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentStatusMidtransUrlAndMidtransBookingCodeInCheckoutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('checkouts', function (Blueprint $table) {
            $table->string('payment_status', 100)->default('pending')->after('email');
            $table->string('midtrans_url')->nullable()->after('payment_status');
            $table->string('transaction_code')->nullable()->after('midtrans_url');
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
            $table->dropColumn('payment_status');
            $table->dropColumn('midtrans_url');
            $table->dropColumn('payment_method');
            $table->dropColumn('transaction_code');
            $table->dropColumn('amount_paid');
        });
    }
}
