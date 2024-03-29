<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->dateTime('payment_date');
            $table->unsignedInteger('order_id');

            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->onDelete('cascade');
            $table->unsignedInteger('type_id');

            $table->foreign('type_id')
                ->references('id')->on('payment_types')
                ->onDelete('cascade');
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
        Schema::dropIfExists('payments');
    }
}
