<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_details_additions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('details_id')->nullable();
            $table->foreign('details_id')->on('order_details')->references('id')->onDelete('cascade');
            $table->unsignedBigInteger('addition_id')->nullable();
            $table->foreign('addition_id')->on('additions')->references('id')->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details_additions');
    }
};
