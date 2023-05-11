<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->on('users')->references('id');
            $table->unsignedBigInteger('address_id')->nullable();
            $table->foreign('address_id')->on('addresses')->references('id');
            $table->unsignedBigInteger('market_id')->nullable();
            $table->foreign('market_id')->on('markets')->references('id');
            $table->unsignedBigInteger('delivery_id')->nullable();
            $table->foreign('delivery_id')->on('deliveries')->references('id');
            $table->enum('status',['not_paid','new','accepted','in_market_way','wait_order','delivery','ended','canceled_from_market','canceled_from_delivery','canceled_from_admin'])->default('new');
            $table->double('from')->default(0.0);
            $table->double('to')->default(0.0);
            $table->double('total')->default(0.0);
            $table->enum('pay_type',['wallet','online'])->default('online');
            $table->double('wallet_pay')->default(0.0);
            $table->double('online_pay')->default(0.0);
            $table->string('notes')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('orders');
    }
}
