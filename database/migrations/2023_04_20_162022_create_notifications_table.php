<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('delivery_id')->nullable();
            $table->foreign('delivery_id')->on('deliveries')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('market_id')->nullable();
            $table->foreign('market_id')->on('markets')->references('id')->onDelete('cascade');
            $table->enum('type',['notification','offer','reward'])->default('notification');
            $table->string('title')->nullable();
            $table->string('message')->nullable();
            $table->string('image')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
