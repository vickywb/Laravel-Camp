<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('checkout_id')->unsigned();
            $table->decimal('price', 16, 2);
            $table->decimal('discount_amount', 16, 2)->nullable();
            $table->decimal('total', 16,2);
            $table->timestamps();

            $table->foreign('checkout_id')
                ->references('id')
                ->on('checkouts')
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
        Schema::dropIfExists('transaction_details');
    }
}
